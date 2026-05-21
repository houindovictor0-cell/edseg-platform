<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::orderBy('nom')->get();
        return view('dashboard.admin-filieres', compact('filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string|max:200',
            'code'               => 'required|string|max:20|unique:filieres',
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
            $data['image'] = $request->file('image')->store('filieres', 'public');
        }

        $filiere = Filiere::create($data);

        Logger::log(
            "Filière créée — {$filiere->nom}",
            'Filiere',
            $filiere->id,
            "Code : {$filiere->code}"
        );

        return redirect()->route('admin.filieres')
            ->with('success', 'Filière ajoutée avec succès.');
    }

    public function edit($id)
    {
        $filiere  = Filiere::findOrFail($id);
        $filieres = Filiere::orderBy('nom')->get();
        return view('dashboard.admin-filieres', compact('filieres', 'filiere'));
    }

    public function update(Request $request, $id)
    {
        $filiere = Filiere::findOrFail($id);

        $request->validate([
            'nom'                => 'required|string|max:200',
            'code'               => 'required|string|max:20|unique:filieres,code,' . $id,
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
            if ($filiere->image && !str_starts_with($filiere->image, 'http')) {
                Storage::disk('public')->delete($filiere->image);
            }
            $data['image'] = $request->file('image')->store('filieres', 'public');
        }

        $filiere->update($data);

        Logger::log(
            "Filière modifiée — {$filiere->nom}",
            'Filiere',
            $id,
            "Publiée : " . ($data['publiee'] ? 'oui' : 'non')
        );

        return redirect()->route('admin.filieres')
            ->with('success', 'Filière mise à jour.');
    }

    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);

        if ($filiere->image && !str_starts_with($filiere->image, 'http')) {
            Storage::disk('public')->delete($filiere->image);
        }

        Logger::log(
            "Filière supprimée — {$filiere->nom}",
            'Filiere',
            $id
        );

        $filiere->delete();

        return redirect()->route('admin.filieres')
            ->with('success', 'Filière supprimée.');
    }
}

