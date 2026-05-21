<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function conditions()
    {
        return view('pages.admission.conditions');
    }

    public function candidature()
    {
        return view('pages.admission.candidature');
    }

    public function soumettre(Request $request)
    {
        $validated = $request->validate([
            'nom'                    => 'required|string|max:100',
            'prenom'                 => 'required|string|max:100',
            'email'                  => 'required|email|unique:candidatures,email',
            'telephone'              => 'nullable|string|max:20',
            'nationalite'            => 'nullable|string|max:100',
            'diplome_obtenu'         => 'required|string|max:200',
            'etablissement_origine'  => 'required|string|max:200',
            'specialite_souhaitee'   => 'required|string|max:200',
            'projet_recherche'       => 'nullable|string',
            'directeur_souhaite'     => 'nullable|string|max:200',
            'dossier_fichier'        => 'nullable|file|mimes:pdf,zip|max:10240',
        ]);

        if ($request->hasFile('dossier_fichier')) {
            $path = $request->file('dossier_fichier')
                ->store('candidatures', 'public');
            $validated['dossier_fichier'] = $path;
        }

        $validated['annee_candidature'] = date('Y');
        Candidature::create($validated);

        return redirect()->back()->with('success',
            'Votre candidature a été soumise avec succès. Nous vous contacterons prochainement.');
    }

    public function calendrier()
    {
        return view('pages.admission.calendrier');
    }
}

 