<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartenaireAdminController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::orderBy('nom')->get();

        return view('dashboard.admin-partenaires', compact('partenaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['image', 'logo']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partenaires', 'public');
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partenaires/logos', 'public');
        }

        $p = Partenaire::create($data);
        Logger::log("Partenaire créé — {$p->nom}", 'Partenaire', $p->id, "Portée : {$p->portee}");

        return redirect()->route('admin.partenaires')->with('success', 'Partenaire ajouté.');
    }

    public function update(Request $request, $id)
    {
        $p = Partenaire::findOrFail($id);
        $data = $request->except(['image', 'logo']);

        if ($request->hasFile('image')) {
            if ($p->image && ! str_starts_with($p->image, 'http')) {
                Storage::disk('public')->delete($p->image);
            }
            $data['image'] = $request->file('image')->store('partenaires', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($p->logo && ! str_starts_with($p->logo, 'http')) {
                Storage::disk('public')->delete($p->logo);
            }
            $data['logo'] = $request->file('logo')->store('partenaires/logos', 'public');
        }

        $p->update($data);
        Logger::log("Partenaire modifié — {$p->nom}", 'Partenaire', $id);

        return redirect()->route('admin.partenaires')->with('success', 'Partenaire mis à jour.');
    }

    public function destroy($id)
    {
        $p = Partenaire::findOrFail($id);
        if ($p->image && ! str_starts_with($p->image, 'http')) {
            Storage::disk('public')->delete($p->image);
        }
        if ($p->logo && ! str_starts_with($p->logo, 'http')) {
            Storage::disk('public')->delete($p->logo);
        }
        Logger::log("Partenaire supprimé — {$p->nom}", 'Partenaire', $id);
        $p->delete();

        return redirect()->route('admin.partenaires')->with('success', 'Partenaire supprimé.');
    }
}
