<?php

namespace App\Http\Controllers;

use App\Models\These;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnseignantTheseController extends Controller
{

   public function create()
{
  
    $enseignant = Enseignant::where(
        'user_id',
        Auth::id()
    )->first();

    if (!$enseignant) {
        return redirect()
            ->route('dashboard')
            ->with('error', 'Votre compte n\'est pas associé à un profil enseignant.');
    }


    $doctorants = \App\Models\Doctorant::all();


    return view(
        'dashboard.enseignant-theses-create',
        compact(
            'enseignant',
            'doctorants'
        )
    );
}




    public function store(Request $request)
    {

        $request->validate([

            'titre'=>'required|string|max:255',

            'date_debut'=>'required|date',

            'resume'=>'nullable|string',

            'mot_cles'=>'nullable|string',

        ]);



        $enseignant = Enseignant::where(
            'user_id',
            Auth::id()
        )->firstOrFail();



        These::create([

            'titre'=>$request->titre,

            'date_debut'=>$request->date_debut,

            'resume'=>$request->resume,

            'mot_cles'=>$request->mot_cles,

            'statut'=>'en_cours',

            'publiee'=>false,

            'directeur_id'=>$enseignant->id,

        ]);



        return redirect()
            ->route('enseignant.theses')
            ->with(
                'success',
                'Nouvelle thèse ajoutée avec succès.'
            );

    }

}

