<?php
namespace App\Http\Controllers;
use App\Models\These;
use App\Models\Laboratoire;

class RechercheController extends Controller
{
    public function axes()
{
    $axes = \App\Models\AxeRecherche::where('actif', true)->orderBy('ordre')->get();
    $publications = \App\Models\Publication::with('enseignant')
        ->orderByDesc('annee_publication')
        ->orderByDesc('created_at')
        ->paginate(9);
    return view('pages.recherche.axes', compact('axes', 'publications'));
}

    public function laboratoires()
    {
        $laboratoires = Laboratoire::orderBy('nom')->get();
        return view('pages.recherche.laboratoires', compact('laboratoires'));
    }

    public function projets()
{
    $projets = \App\Models\ProjetRecherche::with('laboratoire')
        ->where('publie', true)
        ->orderBy('ordre')
        ->get();

    return view('pages.recherche.projets', compact('projets'));
}
    public function theses()
    {
        $theses = These::where('publiee', true)
            ->where('statut', 'soutenue')
            ->with(['doctorant', 'directeur'])
            ->orderBy('date_soutenance', 'desc')
            ->paginate(10);
        return view('pages.recherche.theses', compact('theses'));
    }

    public function these($id)
    {

    $these = These::with(['doctorant', 'directeur', 'documents'])->findOrFail($id);
        $these = These::where('publiee', true)
            ->where('statut', 'soutenue')
            ->with(['doctorant', 'directeur'])
            ->findOrFail($id);

        $autresTheses = These::where('publiee', true)
            ->where('statut', 'soutenue')
            ->where('id', '!=', $id)
            ->with(['doctorant', 'directeur'])
            ->orderBy('date_soutenance', 'desc')
            ->take(3)->get();

        return view('pages.recherche.these-detail', compact('these', 'autresTheses'));
    }

    public function ethique() { return view('pages.recherche.ethique'); }
}
