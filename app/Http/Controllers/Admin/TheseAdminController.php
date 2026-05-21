<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\These;
use App\Models\Doctorant;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class TheseAdminController extends Controller
{
    public function index()
    {
        $theses     = These::with(['doctorant', 'directeur'])
                        ->orderBy('created_at', 'desc')->get();
        $doctorants = Doctorant::orderBy('nom')->get();
        $directeurs = Enseignant::where('est_directeur_these', true)->get();
        return view('dashboard.admin-theses', compact('theses', 'doctorants', 'directeurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'        => 'required|string|max:500',
            'doctorant_id' => 'required|exists:doctorants,id',
            'directeur_id' => 'required|exists:enseignants,id',
            'date_debut'   => 'required|date',

            
        ]);

        $these = These::create($request->all());

        Logger::log(
            "Thèse créée — {$these->titre}",
            'These',
            $these->id,
            "Doctorant ID : {$these->doctorant_id}"
        );

        return redirect()->route('admin.theses')
            ->with('success', 'Thèse ajoutée.');
    }

    public function update(Request $request, $id)
    {
        $these = These::findOrFail($id);
        $these->update(array_merge($request->all(), [
            'publiee' => $request->has('publiee'),
        ]));

        Logger::log(
            "Thèse modifiée — {$these->titre}",
            'These',
            $id,
            "Statut : {$request->statut}"
        );

        return redirect()->route('admin.theses')
            ->with('success', 'Thèse mise à jour.');
    }

    public function destroy($id)
    {
        $these = These::findOrFail($id);

        Logger::log(
            "Thèse supprimée — {$these->titre}",
            'These',
            $id
        );

        $these->delete();

        return redirect()->route('admin.theses')
            ->with('success', 'Thèse supprimée.');
    }
}

