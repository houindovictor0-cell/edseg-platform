<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\AxeRecherche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RechercheAdminController extends Controller
{
    public function index()
    {
        $axes = AxeRecherche::orderBy('ordre')->get();
        return view('dashboard.admin-recherche', compact('axes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'mots_cles'   => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
        ]);

        $data = $request->except('image');
        $data['actif'] = true;
        $data['ordre'] = AxeRecherche::max('ordre') + 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('axes', 'public');
        }

        $axe = AxeRecherche::create($data);
        Logger::log("Axe de recherche créé — {$axe->titre}", 'AxeRecherche', $axe->id);
        return redirect()->route('admin.recherche')->with('success', 'Axe ajouté.');
    }

    public function update(Request $request, $id)
    {
        $axe = AxeRecherche::findOrFail($id);
        $data = $request->except('image');
        $data['actif'] = $request->has('actif');

        if ($request->hasFile('image')) {
            if ($axe->image && !str_starts_with($axe->image, 'http')) {
                Storage::disk('public')->delete($axe->image);
            }
            $data['image'] = $request->file('image')->store('axes', 'public');
        }

        $axe->update($data);
        Logger::log("Axe modifié — {$axe->titre}", 'AxeRecherche', $id);
        return redirect()->route('admin.recherche')->with('success', 'Axe mis à jour.');
    }

    public function destroy($id)
    {
        $axe = AxeRecherche::findOrFail($id);
        if ($axe->image && !str_starts_with($axe->image, 'http')) {
            Storage::disk('public')->delete($axe->image);
        }
        Logger::log("Axe supprimé — {$axe->titre}", 'AxeRecherche', $id);
        $axe->delete();
        return redirect()->route('admin.recherche')->with('success', 'Axe supprimé.');
    }
}

