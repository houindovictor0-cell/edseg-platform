<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Enseignant;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::with('enseignant')
            ->orderByDesc('annee_publication')
            ->orderByDesc('created_at')
            ->get();
        $enseignants = Enseignant::orderBy('nom')->get();

        return view('dashboard.admin-publications', compact('publications', 'enseignants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'enseignant_id'     => 'required|exists:enseignants,id',
            'titre'             => 'required|string|max:255',
            'resume'            => 'nullable|string',
            'auteurs'           => 'required|string|max:255',
            'revue'             => 'nullable|string|max:255',
            'annee_publication' => 'required|integer|min:1950|max:'.(date('Y') + 1),
            'doi'               => 'nullable|string|max:255',
            'lien_externe'      => 'nullable|url|max:255',
            'type'              => 'required|in:article,ouvrage,chapitre,conference',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'fichier'           => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('publications/photos', 'public');
        }
        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('publications/fichiers', 'public');
        }

        $publication = Publication::create($data);
        Logger::log("Publication créée — {$publication->titre}", 'Publication', $publication->id);

        return redirect()->route('admin.publications')->with('success', 'Publication ajoutée.');
    }

    public function update(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        $data = $request->validate([
            'enseignant_id'     => 'required|exists:enseignants,id',
            'titre'             => 'required|string|max:255',
            'resume'            => 'nullable|string',
            'auteurs'           => 'required|string|max:255',
            'revue'             => 'nullable|string|max:255',
            'annee_publication' => 'required|integer|min:1950|max:'.(date('Y') + 1),
            'doi'               => 'nullable|string|max:255',
            'lien_externe'      => 'nullable|url|max:255',
            'type'              => 'required|in:article,ouvrage,chapitre,conference',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'fichier'           => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            if ($publication->photo && !str_starts_with($publication->photo, 'http')) {
                Storage::disk('public')->delete($publication->photo);
            }
            $data['photo'] = $request->file('photo')->store('publications/photos', 'public');
        } else {
            unset($data['photo']);
        }

        if ($request->hasFile('fichier')) {
            if ($publication->fichier) {
                Storage::disk('public')->delete($publication->fichier);
            }
            $data['fichier'] = $request->file('fichier')->store('publications/fichiers', 'public');
        } else {
            unset($data['fichier']);
        }

        $publication->update($data);
        Logger::log("Publication modifiée — {$publication->titre}", 'Publication', $id);

        return redirect()->route('admin.publications')->with('success', 'Publication mise à jour.');
    }

    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->photo && !str_starts_with($publication->photo, 'http')) {
            Storage::disk('public')->delete($publication->photo);
        }
        if ($publication->fichier) {
            Storage::disk('public')->delete($publication->fichier);
        }

        Logger::log("Publication supprimée — {$publication->titre}", 'Publication', $id);
        $publication->delete();

        return redirect()->route('admin.publications')->with('success', 'Publication supprimée.');
    }
}
