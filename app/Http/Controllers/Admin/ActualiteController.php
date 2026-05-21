<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::orderBy('created_at', 'desc')->paginate(15);
        return view('dashboard.admin-actualites', compact('actualites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'     => 'required|string|max:255',
            'contenu'   => 'required|string',
            'categorie' => 'required|in:actualite,communique,offre,soutenance,colloque',
            'image'     => 'nullable|image|max:4096',
        ]);

        $data = $request->except('image');
        $data['user_id']          = Auth::id();
        $data['publiee']          = true;
        $data['date_publication'] = now();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        $actualite = Actualite::create($data);

        Logger::log(
            "Actualité publiée — {$request->titre}",
            'Actualite',
            $actualite->id,
            "Catégorie : {$request->categorie}"
        );

        return redirect()->route('admin.actualites')
            ->with('success', 'Actualité publiée avec succès.');
    }

    public function edit($id)
    {
        $actualite = Actualite::findOrFail($id);
        return view('dashboard.admin-actualite-edit', compact('actualite'));
    }

    public function update(Request $request, $id)
    {
        $actualite = Actualite::findOrFail($id);

        $request->validate([
            'titre'     => 'required|string|max:255',
            'contenu'   => 'required|string',
            'categorie' => 'required|in:actualite,communique,offre,soutenance,colloque',
            'image'     => 'nullable|image|max:4096',
            'publiee'   => 'nullable|boolean',
        ]);

        $data = $request->only(['titre', 'contenu', 'categorie']);
        $data['publiee'] = $request->has('publiee') ? true : false;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        $actualite->update($data);

        Logger::log(
            "Actualité modifiée — {$actualite->titre}",
            'Actualite',
            $id,
            "Statut : " . ($data['publiee'] ? 'publiée' : 'brouillon')
        );

        return redirect()->route('admin.actualites')
            ->with('success', 'Actualité mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $actualite = Actualite::findOrFail($id);

        Logger::log(
            "Actualité supprimée — {$actualite->titre}",
            'Actualite',
            $id
        );

        $actualite->delete();

        return redirect()->route('admin.actualites')
            ->with('success', 'Actualité supprimée.');
    }

    public function togglePublication($id)
    {
        $actualite = Actualite::findOrFail($id);
        $actualite->update([
            'publiee'          => !$actualite->publiee,
            'date_publication' => !$actualite->publiee ? now() : $actualite->date_publication,
        ]);

        Logger::log(
            $actualite->publiee ? "Actualité publiée — {$actualite->titre}" : "Actualité dépubliée — {$actualite->titre}",
            'Actualite',
            $id
        );

        return redirect()->back()
            ->with('success', $actualite->publiee ? 'Actualité publiée.' : 'Actualité dépubliée.');
    }
}

