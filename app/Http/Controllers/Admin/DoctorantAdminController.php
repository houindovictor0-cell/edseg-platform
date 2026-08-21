<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Doctorant;
use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorantAdminController extends Controller
{
    public function index()
    {
        $doctorants = Doctorant::with(['user', 'directeur'])->orderBy('nom')->get();
        $directeurs = Enseignant::where('est_directeur_these', true)->orderBy('nom')->get();
        return view('dashboard.admin-doctorants', compact('doctorants', 'directeurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string|max:150',
            'prenom'             => 'required|string|max:150',
            'email'              => 'required|email|unique:users,email',
            'password'           => 'required|min:8',
            'matricule'          => 'required|string|max:50|unique:doctorants',
            'telephone'          => 'nullable|string|max:30',
            'nationalite'        => 'nullable|string|max:100',
            'specialite'         => 'nullable|string|max:150',
            'titre_these'        => 'nullable|string',
            'directeur_id'       => 'nullable|exists:enseignants,id',
            'statut'             => 'required|in:actif,suspendu,diplome,abandon',
            'annee_inscription'  => 'required|integer|min:2000|max:2099',
        ]);

        $user = User::create([
            'name'              => $request->prenom . ' ' . $request->nom,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role_souhaite'     => 'doctorant',
            'is_approved'       => true,
            'approved_at'       => now(),
            'approved_by'       => auth()->id(),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('doctorant');

        $doctorant = Doctorant::create([
            'user_id'           => $user->id,
            'matricule'         => $request->matricule,
            'nom'               => $request->nom,
            'prenom'            => $request->prenom,
            'telephone'         => $request->telephone,
            'nationalite'       => $request->nationalite,
            'specialite'        => $request->specialite,
            'titre_these'       => $request->titre_these,
            'directeur_id'      => $request->directeur_id,
            'statut'            => $request->statut,
            'annee_inscription' => $request->annee_inscription,
        ]);

        Logger::log(
            "Doctorant créé — {$doctorant->prenom} {$doctorant->nom}",
            'Doctorant',
            $doctorant->id,
            "Matricule : {$doctorant->matricule}"
        );

        return redirect()->route('admin.doctorants')
            ->with('success', 'Doctorant créé avec succès. Identifiants transmis par email si configuré.');
    }

    public function edit($id)
    {
        $doctorant  = Doctorant::with('user')->findOrFail($id);
        $doctorants = Doctorant::with(['user', 'directeur'])->orderBy('nom')->get();
        $directeurs = Enseignant::where('est_directeur_these', true)->orderBy('nom')->get();
        return view('dashboard.admin-doctorants', compact('doctorants', 'doctorant', 'directeurs'));
    }

    public function update(Request $request, $id)
    {
        $doctorant = Doctorant::findOrFail($id);

        $request->validate([
            'nom'                => 'required|string|max:150',
            'prenom'             => 'required|string|max:150',
            'matricule'          => 'required|string|max:50|unique:doctorants,matricule,' . $id,
            'telephone'          => 'nullable|string|max:30',
            'nationalite'        => 'nullable|string|max:100',
            'specialite'         => 'nullable|string|max:150',
            'titre_these'        => 'nullable|string',
            'directeur_id'       => 'nullable|exists:enseignants,id',
            'statut'             => 'required|in:actif,suspendu,diplome,abandon',
            'annee_inscription'  => 'required|integer|min:2000|max:2099',
        ]);

        $doctorant->update($request->only([
            'nom', 'prenom', 'matricule', 'telephone', 'nationalite',
            'specialite', 'titre_these', 'directeur_id', 'statut', 'annee_inscription',
        ]));

        if ($doctorant->user) {
            $doctorant->user->update(['name' => $request->prenom . ' ' . $request->nom]);
        }

        Logger::log(
            "Doctorant modifié — {$doctorant->prenom} {$doctorant->nom}",
            'Doctorant',
            $id
        );

        return redirect()->route('admin.doctorants')
            ->with('success', 'Doctorant mis à jour.');
    }

    public function destroy($id)
    {
        $doctorant = Doctorant::findOrFail($id);
        $nom = "{$doctorant->prenom} {$doctorant->nom}";
        $userId = $doctorant->user_id;

        Logger::log("Doctorant supprimé — {$nom}", 'Doctorant', $id);

        $doctorant->delete();
        // Le compte User associé reste, sauf suppression explicite via la gestion des utilisateurs

        return redirect()->route('admin.doctorants')
            ->with('success', "Profil doctorant de {$nom} supprimé.");
    }
}

