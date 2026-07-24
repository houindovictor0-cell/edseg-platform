<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Actualite;

class ActualiteController extends Controller
{
    public function index(Request $request)
{
    $query = Actualite::query();

    if ($request->filled('categorie')) {
        $query->where('categorie', $request->categorie);
    }

    $actualites = $query
        ->orderByDesc('date_publication')
        ->paginate(9)
        ->withQueryString();

    return view('pages.actualites.index', compact('actualites'));
}

    public function show($id)
    {
        $actualite = Actualite::where('publiee', true)->findOrFail($id);
        $recentes = Actualite::where('publiee', true)
            ->where('id', '!=', $id)
            ->orderBy('date_publication', 'desc')
            ->take(3)->get();
        return view('pages.actualites.show', compact('actualite', 'recentes'));
    }
}
