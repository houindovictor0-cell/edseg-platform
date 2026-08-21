<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EnseignantAdminController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::with('user')->orderBy('nom')->get();
        return view('dashboard.admin-enseignants', compact('enseignants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'                  => 'required|string|max:150',
            'prenom'               => 'required|string|max:150',
            'email'                => 'nullable|email|unique:users,email',
            'password'             => 'nullable|min:8|required_with:email',
            'matricule'            => 'nullable|string|max:50|unique:enseignants',
            'telephone'            => 'nullable|string|max:30',
            'grade'                => 'required|string|max:100',
            'specialite'           => 'required|string|max:150',
            'etablissement'        => 'required|string|max:200',
            'option'               => 'nullable|string|max:150',
            'provenance'           => 'nullable|string|max:150',
            'pays'                 => 'nullable|string|max:100',
            'biographie'           => 'nullable|string',
            'quota_theses'         => 'nullable|integer|min:0',
        ]);

        $userId = null;

        if ($request->filled('email')) {
            $user = User::create([
                'name'              => $request->prenom . ' ' . $request->nom,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'role_souhaite'     => 'enseignant',
                'is_approved'       => true,
                'approved_at'       => now(),
                'approved_by'       => auth()->id(),
                'email_verified_at' => now(),
            ]);
            $user->assignRole('enseignant');
            $userId = $user->id;
        }

        $enseignant = Enseignant::create([
            'user_id'             => $userId,
            'matricule'           => $request->matricule,
            'nom'                 => $request->nom,
            'prenom'              => $request->prenom,
            'telephone'           => $request->telephone,
            'grade'               => $request->grade,
            'specialite'          => $request->specialite,
            'etablissement'       => $request->etablissement,
            'est_directeur_these' => $request->has('est_directeur_these'),
            'quota_theses'        => $request->quota_theses ?? 0,
            'option'              => $request->option,
            'provenance'          => $request->provenance,
            'pays'                => $request->pays,
            'biographie'          => $request->biographie,
        ]);

        Logger::log(
            "Enseignant créé — {$enseignant->prenom} {$enseignant->nom}",
            'Enseignant',
            $enseignant->id,
            "Grade : {$enseignant->grade}"
        );

        return redirect()->route('admin.enseignants')
            ->with('success', 'Enseignant ajouté avec succès.');
    }

    public function edit($id)
    {
        $enseignant  = Enseignant::with('user')->findOrFail($id);
        $enseignants = Enseignant::with('user')->orderBy('nom')->get();
        return view('dashboard.admin-enseignants', compact('enseignants', 'enseignant'));
    }

    public function update(Request $request, $id)
    {
        $enseignant = Enseignant::findOrFail($id);

        $request->validate([
            'nom'                  => 'required|string|max:150',
            'prenom'               => 'required|string|max:150',
            'matricule'            => 'nullable|string|max:50|unique:enseignants,matricule,' . $id,
            'telephone'            => 'nullable|string|max:30',
            'grade'                => 'required|string|max:100',
            'specialite'           => 'required|string|max:150',
            'etablissement'        => 'required|string|max:200',
            'option'               => 'nullable|string|max:150',
            'provenance'           => 'nullable|string|max:150',
            'pays'                 => 'nullable|string|max:100',
            'biographie'           => 'nullable|string',
            'quota_theses'         => 'nullable|integer|min:0',
        ]);

        $enseignant->update([
            'nom'                 => $request->nom,
            'prenom'              => $request->prenom,
            'matricule'           => $request->matricule,
            'telephone'           => $request->telephone,
            'grade'               => $request->grade,
            'specialite'          => $request->specialite,
            'etablissement'       => $request->etablissement,
            'est_directeur_these' => $request->has('est_directeur_these'),
            'quota_theses'        => $request->quota_theses ?? 0,
            'option'              => $request->option,
            'provenance'          => $request->provenance,
            'pays'                => $request->pays,
            'biographie'          => $request->biographie,
        ]);

        if ($enseignant->user) {
            $enseignant->user->update(['name' => $request->prenom . ' ' . $request->nom]);
        }

        Logger::log(
            "Enseignant modifié — {$enseignant->prenom} {$enseignant->nom}",
            'Enseignant',
            $id
        );

        return redirect()->route('admin.enseignants')
            ->with('success', 'Enseignant mis à jour.');
    }

    public function destroy($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $nom = "{$enseignant->prenom} {$enseignant->nom}";

        Logger::log("Enseignant supprimé — {$nom}", 'Enseignant', $id);

        $enseignant->delete();

        return redirect()->route('admin.enseignants')
            ->with('success', "Profil de {$nom} supprimé.");
    }
}

