<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Archive;
use App\Models\Doctorant;
use App\Models\Enseignant;
use App\Models\These;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function show($type, $id)
    {
        if ($type === 'doctorant') {
            $personne = Doctorant::with('archives', 'directeur')->findOrFail($id);
            $these = These::where('doctorant_id', $id)->first();
            $publications = collect();
        } elseif ($type === 'enseignant') {
            $personne = Enseignant::with('archives')->findOrFail($id);
            $these = null;
            $publications = Publication::where('enseignant_id', $id)->orderByDesc('annee_publication')->get();
        } else {
            abort(404);
        }

        return view('dashboard.admin-archive', compact('personne', 'type', 'these', 'publications'));
    }

    public function store(Request $request, $type, $id)
    {
        $request->validate([
            'titre'          => 'required|string|max:200',
            'type'           => 'required|in:these,publication,distinction,rapport,note,autre',
            'description'    => 'nullable|string',
            'date_evenement' => 'nullable|date',
            'fichier'        => 'nullable|file|max:15360',
        ]);

        $modelClass = $type === 'doctorant' ? Doctorant::class : Enseignant::class;
        $personne = $modelClass::findOrFail($id);

        $data = $request->only(['titre', 'type', 'description', 'date_evenement']);
        $data['archivable_id']   = $personne->id;
        $data['archivable_type'] = $modelClass;
        $data['cree_par']        = auth()->id();

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('archives', 'public');
        }

        Archive::create($data);

        Logger::log(
            "Archive ajoutée — {$request->titre}",
            'Archive',
            null,
            ucfirst($type) . " : {$personne->prenom} {$personne->nom}"
        );

        return redirect()->route('admin.archive', [$type, $id])
            ->with('success', 'Entrée d\'archive ajoutée.');
    }

    public function destroy($entryId)
    {
        $archive = Archive::findOrFail($entryId);
        $type = $archive->archivable_type === Doctorant::class ? 'doctorant' : 'enseignant';
        $personneId = $archive->archivable_id;

        if ($archive->fichier) {
            Storage::disk('public')->delete($archive->fichier);
        }

        Logger::log("Archive supprimée — {$archive->titre}", 'Archive', null);

        $archive->delete();

        return redirect()->route('admin.archive', [$type, $personneId])
            ->with('success', 'Entrée d\'archive supprimée.');
    }
}

