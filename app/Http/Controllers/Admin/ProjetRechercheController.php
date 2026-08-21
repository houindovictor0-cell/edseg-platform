<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\ProjetRecherche;
use App\Models\Laboratoire;
use Illuminate\Http\Request;

class ProjetRechercheController extends Controller
{
    public function index()
    {
        $projets = ProjetRecherche::with('laboratoire')->orderBy('ordre')->get();
        $laboratoires = Laboratoire::orderBy('nom')->get();
        return view('dashboard.admin-projets', compact('projets', 'laboratoires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'laboratoire_id' => 'required|exists:laboratoires,id',
            'titre'          => 'required|string|max:255',
            'description'    => 'required|string',
            'periode'        => 'nullable|string|max:50',
            'bailleur'       => 'nullable|string|max:150',
            'statut'         => 'required|in:planifie,en_cours,termine',
        ]);

        $data = $request->all();
        $data['publie'] = $request->has('publie');
        $data['ordre'] = ProjetRecherche::max('ordre') + 1;

        $projet = ProjetRecherche::create($data);
        Logger::log("Projet de recherche créé — {$projet->titre}", 'ProjetRecherche', $projet->id);

        return redirect()->route('admin.projets')->with('success', 'Projet ajouté.');
    }

    public function edit($id)
    {
        $projet = ProjetRecherche::findOrFail($id);
        $projets = ProjetRecherche::with('laboratoire')->orderBy('ordre')->get();
        $laboratoires = Laboratoire::orderBy('nom')->get();
        return view('dashboard.admin-projets', compact('projets', 'projet', 'laboratoires'));
    }

    public function update(Request $request, $id)
    {
        $projet = ProjetRecherche::findOrFail($id);

        $request->validate([
            'laboratoire_id' => 'required|exists:laboratoires,id',
            'titre'          => 'required|string|max:255',
            'description'    => 'required|string',
            'periode'        => 'nullable|string|max:50',
            'bailleur'       => 'nullable|string|max:150',
            'statut'         => 'required|in:planifie,en_cours,termine',
        ]);

        $data = $request->all();
        $data['publie'] = $request->has('publie');

        $projet->update($data);
        Logger::log("Projet de recherche modifié — {$projet->titre}", 'ProjetRecherche', $id);

        return redirect()->route('admin.projets')->with('success', 'Projet mis à jour.');
    }

    public function destroy($id)
    {
        $projet = ProjetRecherche::findOrFail($id);
        Logger::log("Projet de recherche supprimé — {$projet->titre}", 'ProjetRecherche', $id);
        $projet->delete();

        return redirect()->route('admin.projets')->with('success', 'Projet supprimé.');
    }
}

