<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Enseignant;
use App\Models\Mention;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EnseignantAdminController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::with(['user', 'mention', 'specialites', 'publications'])->orderBy('nom')->get();
        $specialites = Specialite::with('mention')->orderBy('nom')->get();
        $mentions    = Mention::orderBy('nom')->get();
        return view('dashboard.admin-enseignants', compact('enseignants', 'specialites', 'mentions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'                  => 'required|string|max:150',
            'prenom'               => 'required|string|max:150',
            'matricule'            => 'nullable|string|max:50|unique:enseignants',
            'telephone'            => 'nullable|string|max:30',
            'email'                => 'nullable|email|max:255',
            'grade'                => 'required|string|max:100',
            'specialite'           => 'required|string|max:150',
            'mention_id'           => 'nullable|exists:mentions,id',
            'etablissement'        => 'required|string|max:200',
            'option'               => 'nullable|string|max:150',
            'provenance'           => 'nullable|string|max:150',
            'pays'                 => 'nullable|string|max:100',
            'biographie'           => 'nullable|string',
            'notes'                => 'nullable|string',
            'quota_theses'         => 'nullable|integer|min:0',
            'photo'                => 'nullable|image|max:2048',
            'specialites_enseignees' => 'nullable|array',
            'specialites_enseignees.*' => 'exists:specialites,id',
        ]);

        $data = [
            'matricule'           => $request->matricule,
            'nom'                 => $request->nom,
            'prenom'              => $request->prenom,
            'telephone'           => $request->telephone,
            'email'               => $request->email,
            'grade'               => $request->grade,
            'specialite'          => $request->specialite,
            'mention_id'          => $request->mention_id,
            'etablissement'       => $request->etablissement,
            'est_directeur_these' => $request->has('est_directeur_these'),
            'quota_theses'        => $request->quota_theses ?? 0,
            'option'              => $request->option,
            'provenance'          => $request->provenance,
            'pays'                => $request->pays,
            'biographie'          => $request->biographie,
            'notes'               => $request->notes,
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('enseignants/photos', 'public');
        }

        $enseignant = Enseignant::create($data);
        $enseignant->specialites()->sync($request->input('specialites_enseignees', []));

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
        $enseignant  = Enseignant::with(['user', 'mention', 'specialites', 'publications'])->findOrFail($id);
        $enseignants = Enseignant::with(['user', 'mention', 'specialites', 'publications'])->orderBy('nom')->get();
        $specialites = Specialite::with('mention')->orderBy('nom')->get();
        $mentions    = Mention::orderBy('nom')->get();
        return view('dashboard.admin-enseignants', compact('enseignants', 'enseignant', 'specialites', 'mentions'));
    }

    public function update(Request $request, $id)
    {
        $enseignant = Enseignant::findOrFail($id);

        $request->validate([
            'nom'                  => 'required|string|max:150',
            'prenom'               => 'required|string|max:150',
            'matricule'            => 'nullable|string|max:50|unique:enseignants,matricule,' . $id,
            'telephone'            => 'nullable|string|max:30',
            'email'                => 'nullable|email|max:255',
            'grade'                => 'required|string|max:100',
            'specialite'           => 'required|string|max:150',
            'mention_id'           => 'nullable|exists:mentions,id',
            'etablissement'        => 'required|string|max:200',
            'option'               => 'nullable|string|max:150',
            'provenance'           => 'nullable|string|max:150',
            'pays'                 => 'nullable|string|max:100',
            'biographie'           => 'nullable|string',
            'notes'                => 'nullable|string',
            'quota_theses'         => 'nullable|integer|min:0',
            'photo'                => 'nullable|image|max:2048',
            'specialites_enseignees' => 'nullable|array',
            'specialites_enseignees.*' => 'exists:specialites,id',
        ]);

        $data = [
            'nom'                 => $request->nom,
            'prenom'              => $request->prenom,
            'matricule'           => $request->matricule,
            'telephone'           => $request->telephone,
            'email'               => $request->email,
            'grade'               => $request->grade,
            'specialite'          => $request->specialite,
            'mention_id'          => $request->mention_id,
            'etablissement'       => $request->etablissement,
            'est_directeur_these' => $request->has('est_directeur_these'),
            'quota_theses'        => $request->quota_theses ?? 0,
            'option'              => $request->option,
            'provenance'          => $request->provenance,
            'pays'                => $request->pays,
            'biographie'          => $request->biographie,
            'notes'               => $request->notes,
        ];

        if ($request->hasFile('photo')) {
            if ($enseignant->photo) {
                Storage::disk('public')->delete($enseignant->photo);
            }
            $data['photo'] = $request->file('photo')->store('enseignants/photos', 'public');
        }

        $enseignant->update($data);
        $enseignant->specialites()->sync($request->input('specialites_enseignees', []));

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

        if ($enseignant->photo) {
            Storage::disk('public')->delete($enseignant->photo);
        }

        $enseignant->delete();

        return redirect()->route('admin.enseignants')
            ->with('success', "Profil de {$nom} supprimé.");
    }
}
