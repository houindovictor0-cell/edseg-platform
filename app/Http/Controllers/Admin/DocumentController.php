<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin-documents', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'         => 'required|string|max:200',
            'description'   => 'nullable|string',
            'categorie'     => 'required|in:formulaire,guide,charte,rapport,resultat,autre',
            'type_resultat' => 'required_if:categorie,resultat|nullable|in:preselection,test_prepa,annuel',
            'annee'         => 'nullable|string|max:9',
            'acces'         => 'required|in:public,membres',
            'fichier'       => 'required|file|mimes:pdf|max:10240',
        ]);

        $data = $request->except('fichier');
        $data['fichier'] = $request->file('fichier')->store('documents', 'public');
        $data['type_resultat'] = $request->categorie === 'resultat' ? $request->type_resultat : null;

        $document = Document::create($data);

        Logger::log(
            "Document publié — {$document->titre}",
            'Document',
            $document->id,
            "Catégorie : {$document->categorie}"
        );

        return redirect()->route('admin.documents')
            ->with('success', 'Document publié avec succès.');
    }

    public function edit($id)
    {
        $document  = Document::findOrFail($id);
        $documents = Document::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin-documents', compact('documents', 'document'));
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'titre'         => 'required|string|max:200',
            'description'   => 'nullable|string',
            'categorie'     => 'required|in:formulaire,guide,charte,rapport,resultat,autre',
            'type_resultat' => 'required_if:categorie,resultat|nullable|in:preselection,test_prepa,annuel',
            'annee'         => 'nullable|string|max:9',
            'acces'         => 'required|in:public,membres',
            'fichier'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = $request->except('fichier');
        $data['type_resultat'] = $request->categorie === 'resultat' ? $request->type_resultat : null;

        if ($request->hasFile('fichier')) {
            Storage::disk('public')->delete($document->fichier);
            $data['fichier'] = $request->file('fichier')->store('documents', 'public');
        }

        $document->update($data);

        Logger::log(
            "Document modifié — {$document->titre}",
            'Document',
            $id
        );

        return redirect()->route('admin.documents')
            ->with('success', 'Document mis à jour.');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::disk('public')->delete($document->fichier);

        Logger::log("Document supprimé — {$document->titre}", 'Document', $id);

        $document->delete();

        return redirect()->route('admin.documents')
            ->with('success', 'Document supprimé.');
    }

    public function telecharger($id)
    {
        $document = Document::findOrFail($id);
        $document->increment('telechargements');
        return redirect(asset('storage/' . $document->fichier));
    }
}

