<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Bourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BourseAdminController extends Controller
{
    public function index()
    {
        $bourses = Bourse::orderBy('date_limite')->get();
        return view('dashboard.admin-bourses', compact('bourses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'            => 'required|string|max:255',
            'organisme'        => 'required|string|max:255',
            'date_limite'      => 'required|date',
            'type'             => 'required|in:mobilite,recherche,formation,autre',
            'image'            => 'nullable|image|max:4096',
            'fichier'          => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $data = $request->except(['image', 'fichier']);
        $data['active'] = true;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('bourses', 'public');
        }

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('bourses/fichiers', 'public');
        }

        $b = Bourse::create($data);
        Logger::log("Bourse créée — {$b->titre}", 'Bourse', $b->id);
        return redirect()->route('admin.bourses')->with('success', 'Bourse ajoutée.');
    }

    public function update(Request $request, $id)
    {
        $b = Bourse::findOrFail($id);
        $data = $request->except(['image', 'fichier']);
        $data['active'] = $request->has('active');

        if ($request->hasFile('image')) {
            if ($b->image && !str_starts_with($b->image, 'http')) {
                Storage::disk('public')->delete($b->image);
            }
            $data['image'] = $request->file('image')->store('bourses', 'public');
        }

        if ($request->hasFile('fichier')) {
            if ($b->fichier && !str_starts_with($b->fichier, 'http')) {
                Storage::disk('public')->delete($b->fichier);
            }
            $data['fichier'] = $request->file('fichier')->store('bourses/fichiers', 'public');
        }

        $b->update($data);
        Logger::log("Bourse modifiée — {$b->titre}", 'Bourse', $id);
        return redirect()->route('admin.bourses')->with('success', 'Bourse mise à jour.');
    }

    public function destroy($id)
    {
        $b = Bourse::findOrFail($id);
        if ($b->image && !str_starts_with($b->image, 'http')) Storage::disk('public')->delete($b->image);
        if ($b->fichier && !str_starts_with($b->fichier, 'http')) Storage::disk('public')->delete($b->fichier);
        Logger::log("Bourse supprimée — {$b->titre}", 'Bourse', $id);
        $b->delete();
        return redirect()->route('admin.bourses')->with('success', 'Bourse supprimée.');
    }
}
