<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Seminaire;
use App\Models\SeminaireImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeminaireAdminController extends Controller
{
    public function index()
    {
        $seminaires = Seminaire::with('images')->orderBy('date', 'desc')->get();

        return view('dashboard.admin-seminaires', compact('seminaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'lieu' => 'required|string|max:255',
            'affiche' => 'nullable|image|max:4096',
        ]);

        $data = $request->except('affiche');
        if ($request->hasFile('affiche')) {
            $data['affiche'] = $request->file('affiche')->store('seminaires', 'public');
        }

        $s = Seminaire::create($data);
        Logger::log("Séminaire planifié — {$s->titre}", 'Seminaire', $s->id);

        return redirect()->route('admin.seminaires')->with('success', 'Séminaire ajouté.');
    }

    public function update(Request $request, $id)
    {
        $s = Seminaire::findOrFail($id);
        $data = $request->except('affiche');

        if ($request->hasFile('affiche')) {
            if ($s->affiche && ! str_starts_with($s->affiche, 'http')) {
                Storage::disk('public')->delete($s->affiche);
            }
            $data['affiche'] = $request->file('affiche')->store('seminaires', 'public');
        }

        $s->update($data);
        Logger::log("Séminaire modifié — {$s->titre}", 'Seminaire', $id);

        return redirect()->route('admin.seminaires')->with('success', 'Séminaire mis à jour.');
    }

    public function destroy($id)
    {
        $s = Seminaire::findOrFail($id);
        if ($s->affiche && ! str_starts_with($s->affiche, 'http')) {
            Storage::disk('public')->delete($s->affiche);
        }
        Logger::log("Séminaire supprimé — {$s->titre}", 'Seminaire', $id);
        $s->delete();

        return redirect()->route('admin.seminaires')->with('success', 'Séminaire supprimé.');
    }

    public function storeImages(Request $request, $seminaireId)
    {
        $seminaire = Seminaire::findOrFail($seminaireId);

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:4096',
        ]);

        foreach ($request->file('images') as $file) {
            SeminaireImage::create([
                'seminaire_id' => $seminaire->id,
                'image' => $file->store('seminaires/galerie', 'public'),
            ]);
        }

        Logger::log("Photos ajoutées à la galerie — {$seminaire->titre}", 'Seminaire', $seminaire->id);

        return redirect()->route('admin.seminaires')->with('success', 'Photos ajoutées à la galerie.');
    }

    public function destroyImage($id)
    {
        $image = SeminaireImage::findOrFail($id);
        Storage::disk('public')->delete($image->image);
        Logger::log('Photo de galerie supprimée', 'Seminaire', $image->seminaire_id);
        $image->delete();

        return redirect()->route('admin.seminaires')->with('success', 'Photo supprimée.');
    }
}
