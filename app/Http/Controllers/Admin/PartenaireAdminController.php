<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helpers\Logger;
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
            'nom'   => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partenaires', 'public');
        }

        $p = Partenaire::create($data);
        Logger::log("Partenaire créé — {$p->nom}", 'Partenaire', $p->id, "Portée : {$p->portee}");
        return redirect()->route('admin.partenaires')->with('success', 'Partenaire ajouté.');
    }

    public function update(Request $request, $id)
    {
        $p    = Partenaire::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($p->image && !str_starts_with($p->image, 'http')) {
                Storage::disk('public')->delete($p->image);
            }
            $data['image'] = $request->file('image')->store('partenaires', 'public');
        }

        $p->update($data);
        Logger::log("Partenaire modifié — {$p->nom}", 'Partenaire', $id);
        return redirect()->route('admin.partenaires')->with('success', 'Partenaire mis à jour.');
    }

    public function destroy($id)
    {
        $p = Partenaire::findOrFail($id);
        if ($p->image && !str_starts_with($p->image, 'http')) {
            Storage::disk('public')->delete($p->image);
        }
        Logger::log("Partenaire supprimé — {$p->nom}", 'Partenaire', $id);
        $p->delete();
        return redirect()->route('admin.partenaires')->with('success', 'Partenaire supprimé.');
    }
}

