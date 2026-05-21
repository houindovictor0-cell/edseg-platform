<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Seminaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeminaireAdminController extends Controller
{
    public function index()
    {
        $seminaires = Seminaire::orderBy('date', 'desc')->get();
        return view('dashboard.admin-seminaires', compact('seminaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'date'        => 'required|date',
            'heure_debut' => 'required',
            'heure_fin'   => 'required',
            'lieu'        => 'required|string|max:255',
            'affiche'     => 'nullable|image|max:4096',
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
            if ($s->affiche && !str_starts_with($s->affiche, 'http')) {
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
        if ($s->affiche && !str_starts_with($s->affiche, 'http')) {
            Storage::disk('public')->delete($s->affiche);
        }
        Logger::log("Séminaire supprimé — {$s->titre}", 'Seminaire', $id);
        $s->delete();
        return redirect()->route('admin.seminaires')->with('success', 'Séminaire supprimé.');
    }
}

