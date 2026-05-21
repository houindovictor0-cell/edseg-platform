<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\InfoEcole;
use Illuminate\Http\Request;

class EcoleAdminController extends Controller
{
    public function index()
    {
        $infos = InfoEcole::all()->keyBy('cle');
        return view('dashboard.admin-ecole', compact('infos'));
    }

    public function update(Request $request)
    {
        $modifies = [];

        foreach ($request->infos ?? [] as $cle => $valeur) {
            InfoEcole::where('cle', $cle)->update(['valeur' => $valeur ?? '']);
            $modifies[] = $cle;
        }

        Logger::log(
            'Informations de l\'école mises à jour',
            'InfoEcole',
            null,
            'Champs : ' . implode(', ', $modifies)
        );

        return redirect()->route('admin.ecole')
            ->with('success', 'Informations mises à jour. Les pages publiques reflètent immédiatement les changements.');
    }
}

