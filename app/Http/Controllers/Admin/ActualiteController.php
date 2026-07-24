<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        'categorie' => 'required|in:actualite,communique,offre,soutenance,colloque,bourse,mobilite',
        'image'     => 'nullable|image|max:4096',
        'document'  => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
    ]);

    $data = $request->except(['image', 'document']);

    $data['user_id'] = Auth::id();
    $data['publiee'] = true;
    $data['date_publication'] = now();

    // Upload de l'image
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')
            ->store('actualites', 'public');
    }

    // Upload du document
    if ($request->hasFile('document')) {

    $file = $request->file('document');

    $data['document'] = $file->store('actualites/documents', 'public');

    $data['document_nom'] = $file->getClientOriginalName();
}

    $actualite = Actualite::create($data);

    Logger::log(
        "Actualité publiée — {$actualite->titre}",
        'Actualite',
        $actualite->id,
        "Catégorie : {$actualite->categorie}"
    );


    return redirect()
        ->route('admin.actualites')
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
        'categorie' => 'required|in:actualite,communique,offre,soutenance,colloque,bourse,mobilite',
        'image'     => 'nullable|image|max:4096',
        'document'  => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        'publiee'   => 'nullable|boolean',
    ]);

    $data = $request->only([
        'titre',
        'contenu',
        'categorie',
    ]);

    $data['publiee'] = $request->has('publiee');

    // Nouvelle image
    if ($request->hasFile('image')) {

        // Supprimer l'ancienne image
        if ($actualite->image && Storage::disk('public')->exists($actualite->image)) {
            Storage::disk('public')->delete($actualite->image);
        }

        $data['image'] = $request->file('image')
            ->store('actualites', 'public');
    }

    // Nouveau document
    if ($request->hasFile('document')) {

    // Supprimer l'ancien document
    if ($actualite->document && Storage::disk('public')->exists($actualite->document)) {
        Storage::disk('public')->delete($actualite->document);
    }

    $file = $request->file('document');

    // Enregistrer le nouveau document
    $data['document'] = $file->store('actualites/documents', 'public');

    // Garder le vrai nom du document pour l'affichage
    $data['document_nom'] = $file->getClientOriginalName();
}

    $actualite->update($data);

    Logger::log(
        "Actualité modifiée — {$actualite->titre}",
        'Actualite',
        $actualite->id,
        "Statut : " . ($data['publiee'] ? 'publiée' : 'brouillon')
    );

    return redirect()
        ->route('admin.actualites')
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

