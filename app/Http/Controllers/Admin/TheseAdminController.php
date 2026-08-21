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
        'fichier'      => 'nullable|file|mimes:pdf|max:15360',
    ]);

    $data = $request->except('fichier');
    $data['publiee'] = $request->has('publiee');

    if ($request->hasFile('fichier')) {
        $data['fichier'] = $request->file('fichier')->store('theses', 'public');
    }

    $these = These::create($data);

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

    $request->validate([
        'fichier' => 'nullable|file|mimes:pdf|max:15360',
    ]);

    $data = $request->except('fichier');
    $data['publiee'] = $request->has('publiee');

    if ($request->hasFile('fichier')) {
        if ($these->fichier) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($these->fichier);
        }
        $data['fichier'] = $request->file('fichier')->store('theses', 'public');
    }

    $these->update($data);

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

    public function storeDocument(Request $request, $theseId)
{
    $request->validate([
        'titre'          => 'required|string|max:200',
        'type'           => 'required|in:manuscrit,rapport_jury,autorisation,annexe,autre',
        'fichier'        => 'required|file|mimes:pdf|max:15360',
        'visible_public' => 'nullable',
    ]);

    $these = \App\Models\These::findOrFail($theseId);

    \App\Models\DocumentThese::create([
        'these_id'       => $these->id,
        'titre'          => $request->titre,
        'type'           => $request->type,
        'fichier'        => $request->file('fichier')->store('theses-documents', 'public'),
        'visible_public' => $request->has('visible_public'),
        'ordre'          => \App\Models\DocumentThese::where('these_id', $these->id)->max('ordre') + 1,
    ]);

    Logger::log("Document ajouté à la thèse — {$these->titre}", 'These', $these->id, "Document : {$request->titre}");

    return redirect()->route('admin.theses')->with('success', 'Document ajouté à la thèse.');
}

public function destroyDocument($id)
{
    $doc = \App\Models\DocumentThese::findOrFail($id);
    \Illuminate\Support\Facades\Storage::disk('public')->delete($doc->fichier);
    $these = $doc->these;

    Logger::log("Document supprimé d'une thèse — {$these->titre}", 'These', $these->id, "Document : {$doc->titre}");

    $doc->delete();

    return redirect()->route('admin.theses')->with('success', 'Document supprimé.');
}

}

