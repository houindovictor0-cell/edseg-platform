<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Doctorant;
use App\Models\Enseignant;
use App\Models\Mention;
use App\Models\ResultatAnnuelDoctorant;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorantAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctorant::with(['user', 'directeur', 'specialiteRef', 'resultatsAnnuels'])->orderBy('nom');
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        $doctorants  = $query->get();
        $directeurs  = Enseignant::where('est_directeur_these', true)->orderBy('nom')->get();
        $specialites = Specialite::with('mention')->orderBy('nom')->get();
        $mentions    = Mention::orderBy('nom')->get();
        return view('dashboard.admin-doctorants', compact('doctorants', 'directeurs', 'specialites', 'mentions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string|max:150',
            'prenom'             => 'required|string|max:150',
            'matricule'          => 'required|string|max:50|unique:doctorants',
            'telephone'          => 'nullable|string|max:30',
            'email'              => 'nullable|email|max:255',
            'nationalite'        => 'nullable|string|max:100',
            'specialite_id'      => 'nullable|exists:specialites,id',
            'titre_these'        => 'nullable|string',
            'directeur_id'       => 'nullable|exists:enseignants,id',
            'statut'             => 'required|in:actif,suspendu,diplome,abandon',
            'annee_inscription'  => 'required|integer|min:2000|max:2099',
            'photo'              => 'nullable|image|max:2048',
            'notes'              => 'nullable|string',
        ]);

        $specialiteNom = $request->specialite_id
            ? Specialite::find($request->specialite_id)?->nom
            : null;

        $data = [
            'matricule'         => $request->matricule,
            'nom'               => $request->nom,
            'prenom'            => $request->prenom,
            'telephone'         => $request->telephone,
            'email'             => $request->email,
            'nationalite'       => $request->nationalite,
            'specialite_id'     => $request->specialite_id,
            'specialite'        => $specialiteNom,
            'titre_these'       => $request->titre_these,
            'directeur_id'      => $request->directeur_id,
            'statut'            => $request->statut,
            'annee_inscription' => $request->annee_inscription,
            'notes'             => $request->notes,
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctorants/photos', 'public');
        }

        $doctorant = Doctorant::create($data);

        Logger::log(
            "Doctorant créé — {$doctorant->prenom} {$doctorant->nom}",
            'Doctorant',
            $doctorant->id,
            "Matricule : {$doctorant->matricule}"
        );

        return redirect()->route('admin.doctorants')
            ->with('success', 'Doctorant créé avec succès.');
    }

    public function edit($id)
    {
        $doctorant   = Doctorant::with(['user', 'resultatsAnnuels'])->findOrFail($id);
        $doctorants  = Doctorant::with(['user', 'directeur', 'specialiteRef', 'resultatsAnnuels'])->orderBy('nom')->get();
        $directeurs  = Enseignant::where('est_directeur_these', true)->orderBy('nom')->get();
        $specialites = Specialite::with('mention')->orderBy('nom')->get();
        $mentions    = Mention::orderBy('nom')->get();
        return view('dashboard.admin-doctorants', compact('doctorants', 'doctorant', 'directeurs', 'specialites', 'mentions'));
    }

    public function update(Request $request, $id)
    {
        $doctorant = Doctorant::findOrFail($id);

        $request->validate([
            'nom'                => 'required|string|max:150',
            'prenom'             => 'required|string|max:150',
            'matricule'          => 'required|string|max:50|unique:doctorants,matricule,' . $id,
            'telephone'          => 'nullable|string|max:30',
            'email'              => 'nullable|email|max:255',
            'nationalite'        => 'nullable|string|max:100',
            'specialite_id'      => 'nullable|exists:specialites,id',
            'titre_these'        => 'nullable|string',
            'directeur_id'       => 'nullable|exists:enseignants,id',
            'statut'             => 'required|in:actif,suspendu,diplome,abandon',
            'annee_inscription'  => 'required|integer|min:2000|max:2099',
            'photo'              => 'nullable|image|max:2048',
            'notes'              => 'nullable|string',
        ]);

        $data = $request->only([
            'nom', 'prenom', 'matricule', 'telephone', 'email', 'nationalite',
            'specialite_id', 'titre_these', 'directeur_id', 'statut', 'annee_inscription', 'notes',
        ]);

        $data['specialite'] = $request->specialite_id
            ? Specialite::find($request->specialite_id)?->nom
            : $doctorant->specialite;

        if ($request->hasFile('photo')) {
            if ($doctorant->photo) {
                Storage::disk('public')->delete($doctorant->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctorants/photos', 'public');
        }

        $doctorant->update($data);

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

        Logger::log("Doctorant supprimé — {$nom}", 'Doctorant', $id);

        if ($doctorant->photo) {
            Storage::disk('public')->delete($doctorant->photo);
        }
        foreach ($doctorant->resultatsAnnuels as $resultat) {
            Storage::disk('public')->delete($resultat->fichier);
        }

        $doctorant->delete();

        return redirect()->route('admin.doctorants')
            ->with('success', "Profil doctorant de {$nom} supprimé.");
    }

    public function storeResultat(Request $request, $doctorantId)
    {
        $request->validate([
            'annee_universitaire' => 'required|string|max:20',
            'titre'               => 'nullable|string|max:200',
            'fichier'             => 'required|file|mimes:pdf|max:15360',
            'commentaire'         => 'nullable|string',
        ]);

        $doctorant = Doctorant::findOrFail($doctorantId);

        $resultat = ResultatAnnuelDoctorant::create([
            'doctorant_id'        => $doctorant->id,
            'annee_universitaire' => $request->annee_universitaire,
            'titre'               => $request->titre,
            'fichier'             => $request->file('fichier')->store('doctorants/resultats', 'public'),
            'commentaire'         => $request->commentaire,
        ]);

        Logger::log(
            "Résultat annuel ajouté — {$request->annee_universitaire}",
            'ResultatAnnuelDoctorant',
            $resultat->id,
            "Doctorant : {$doctorant->prenom} {$doctorant->nom}"
        );

        return redirect()->route('admin.doctorants.edit', $doctorant->id)
            ->with('success', 'Résultat annuel ajouté.');
    }

    public function destroyResultat($id)
    {
        $resultat = ResultatAnnuelDoctorant::findOrFail($id);
        $doctorantId = $resultat->doctorant_id;

        Storage::disk('public')->delete($resultat->fichier);

        Logger::log(
            "Résultat annuel supprimé — {$resultat->annee_universitaire}",
            'ResultatAnnuelDoctorant',
            $id
        );

        $resultat->delete();

        return redirect()->route('admin.doctorants.edit', $doctorantId)
            ->with('success', 'Résultat annuel supprimé.');
    }
}
