<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Laboratoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaboratoireAdminController extends Controller
{
    public function index()
    {
        $laboratoires = Laboratoire::orderBy('nom')->get();
        return view('dashboard.admin-laboratoires', compact('laboratoires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'   => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('laboratoires', 'public');
        }

        $lab = Laboratoire::create($data);
        Logger::log("Laboratoire créé — {$lab->nom}", 'Laboratoire', $lab->id);
        return redirect()->route('admin.laboratoires')->with('success', 'Laboratoire ajouté.');
    }

    public function update(Request $request, $id)
    {
        $lab  = Laboratoire::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($lab->image && !str_starts_with($lab->image, 'http')) {
                Storage::disk('public')->delete($lab->image);
            }
            $data['image'] = $request->file('image')->store('laboratoires', 'public');
        }

        $lab->update($data);
        Logger::log("Laboratoire modifié — {$lab->nom}", 'Laboratoire', $id);
        return redirect()->route('admin.laboratoires')->with('success', 'Laboratoire mis à jour.');
    }

    public function destroy($id)
    {
        $lab = Laboratoire::findOrFail($id);
        if ($lab->image && !str_starts_with($lab->image, 'http')) {
            Storage::disk('public')->delete($lab->image);
        }
        Logger::log("Laboratoire supprimé — {$lab->nom}", 'Laboratoire', $id);
        $lab->delete();
        return redirect()->route('admin.laboratoires')->with('success', 'Laboratoire supprimé.');
    }
}

