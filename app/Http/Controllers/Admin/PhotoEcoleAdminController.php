<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\PhotoEcole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoEcoleAdminController extends Controller
{
    public function index()
    {
        $photos = PhotoEcole::orderBy('ordre')->orderByDesc('id')->get();

        return view('dashboard.admin-photos', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:4096',
            'legende' => 'nullable|string|max:255',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $photo = PhotoEcole::create([
            'image' => $request->file('image')->store('photos-ecole', 'public'),
            'legende' => $request->legende,
            'ordre' => $request->ordre ?? 0,
        ]);

        Logger::log('Photo album ajoutée', 'PhotoEcole', $photo->id, $photo->legende);

        return redirect()->route('admin.photos')->with('success', 'Photo ajoutée à l\'album.');
    }

    public function destroy($id)
    {
        $photo = PhotoEcole::findOrFail($id);
        Storage::disk('public')->delete($photo->image);
        Logger::log('Photo album supprimée', 'PhotoEcole', $id, $photo->legende);
        $photo->delete();

        return redirect()->route('admin.photos')->with('success', 'Photo supprimée.');
    }
}
