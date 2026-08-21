<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Specialite;
use App\Models\Mention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FiliereController extends Controller
{
    public function index()
    {
        $specialites = Specialite::with('mention')->orderBy('nom')->get();
        $mentions    = Mention::orderBy('nom')->get();
        return view('dashboard.admin-filieres', compact('specialites', 'mentions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mention_id'         => 'required|exists:mentions,id',
            'nom'                => 'required|string|max:200',
            'code'               => 'required|string|max:20|unique:specialites',
            'description'        => 'nullable|string',
            'accroche'           => 'nullable|string|max:300',
            'debouches'          => 'nullable|string',
            'conditions_acces'   => 'nullable|string',
            'programme'          => 'nullable|string',
            'competences'        => 'nullable|string',
            'duree_annees'       => 'required|integer|min:1|max:5',
            'places_disponibles' => 'required|integer|min:1',
            'responsable'        => 'nullable|string|max:200',
            'email_responsable'  => 'nullable|email',
            'image'              => 'nullable|image|max:4096',
        ]);

        $data            = $request->except('image');
        $data['active']  = true;
        $data['publiee'] = $request->has('publiee');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('specialites', 'public');
        }

        $specialite = Specialite::create($data);

        Logger::log(
            "Spécialité créée — {$specialite->nom}",
            'Specialite',
            $specialite->id,
            "Code : {$specialite->code}"
        );

        return redirect()->route('admin.filieres')
            ->with('success', 'Spécialité ajoutée avec succès.');
    }

    public function edit($id)
    {
        $specialite  = Specialite::findOrFail($id);
        $specialites = Specialite::with('mention')->orderBy('nom')->get();
        $mentions    = Mention::orderBy('nom')->get();
        return view('dashboard.admin-filieres', compact('specialites', 'specialite', 'mentions'));
    }

    public function update(Request $request, $id)
    {
        $specialite = Specialite::findOrFail($id);

        $request->validate([
            'mention_id'         => 'required|exists:mentions,id',
            'nom'                => 'required|string|max:200',
            'code'               => 'required|string|max:20|unique:specialites,code,' . $id,
            'description'        => 'nullable|string',
            'accroche'           => 'nullable|string|max:300',
            'debouches'          => 'nullable|string',
            'conditions_acces'   => 'nullable|string',
            'programme'          => 'nullable|string',
            'competences'        => 'nullable|string',
            'duree_annees'       => 'required|integer|min:1|max:5',
            'places_disponibles' => 'required|integer|min:1',
            'responsable'        => 'nullable|string|max:200',
            'email_responsable'  => 'nullable|email',
            'image'              => 'nullable|image|max:4096',
        ]);

        $data            = $request->except('image');
        $data['active']  = $request->has('active');
        $data['publiee'] = $request->has('publiee');

        if ($request->hasFile('image')) {
            if ($specialite->image && !str_starts_with($specialite->image, 'http')) {
                Storage::disk('public')->delete($specialite->image);
            }
            $data['image'] = $request->file('image')->store('specialites', 'public');
        }

        $specialite->update($data);

        Logger::log(
            "Spécialité modifiée — {$specialite->nom}",
            'Specialite',
            $id,
            "Publiée : " . ($data['publiee'] ? 'oui' : 'non')
        );

        return redirect()->route('admin.filieres')
            ->with('success', 'Spécialité mise à jour.');
    }

    public function destroy($id)
    {
        $specialite = Specialite::findOrFail($id);

        if ($specialite->image && !str_starts_with($specialite->image, 'http')) {
            Storage::disk('public')->delete($specialite->image);
        }

        Logger::log(
            "Spécialité supprimée — {$specialite->nom}",
            'Specialite',
            $id
        );

        $specialite->delete();

        return redirect()->route('admin.filieres')
            ->with('success', 'Spécialité supprimée.');
    }
}

