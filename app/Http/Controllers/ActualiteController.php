<?php

namespace App\Http\Controllers;

use App\Models\Actualite;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::where('publiee', true)
            ->orderBy('date_publication', 'desc')
            ->paginate(9);
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
