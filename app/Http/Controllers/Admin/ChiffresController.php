<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\ChiffreCle;
use Illuminate\Http\Request;

class ChiffresController extends Controller
{
    public function index()
    {
        $chiffres = ChiffreCle::orderBy('ordre')->get();
        return view('dashboard.admin-chiffres', compact('chiffres'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'chiffres'         => 'required|array',
            'chiffres.*.valeur' => 'required|string|max:50',
        ]);

        foreach ($request->chiffres as $id => $data) {
            ChiffreCle::where('id', $id)->update(['valeur' => $data['valeur']]);
        }

        Logger::log(
            'Chiffres clés mis à jour',
            'ChiffreCle',
            null,
            implode(', ', array_map(fn($d) => $d['valeur'], $request->chiffres))
        );

        return redirect()->route('admin.chiffres')
            ->with('success', 'Chiffres clés mis à jour avec succès.');
    }
}

