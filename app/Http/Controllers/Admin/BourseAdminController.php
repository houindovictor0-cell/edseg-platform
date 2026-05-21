<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Logger;
use App\Models\Bourse;
use Illuminate\Http\Request;

class BourseAdminController extends Controller
{
    public function index()
    {
        $bourses = Bourse::orderBy('date_limite')->get();
        return view('dashboard.admin-bourses', compact('bourses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'organisme'   => 'required|string|max:255',
            'date_limite' => 'required|date',
            'type'        => 'required|in:mobilite,recherche,formation,autre',
        ]);

        $b = Bourse::create(array_merge($request->all(), ['active' => true]));

        Logger::log(
            "Bourse créée — {$b->titre}",
            'Bourse',
            $b->id,
            "Organisme : {$b->organisme}"
        );

        return redirect()->route('admin.bourses')
            ->with('success', 'Bourse ajoutée.');
    }

    public function update(Request $request, $id)
    {
        $b = Bourse::findOrFail($id);
        $b->update(array_merge($request->all(), [
            'active' => $request->has('active'),
        ]));

        Logger::log(
            "Bourse modifiée — {$b->titre}",
            'Bourse',
            $id
        );

        return redirect()->route('admin.bourses')
            ->with('success', 'Bourse mise à jour.');
    }

    public function destroy($id)
    {
        $b = Bourse::findOrFail($id);

        Logger::log(
            "Bourse supprimée — {$b->titre}",
            'Bourse',
            $id
        );

        $b->delete();

        return redirect()->route('admin.bourses')
            ->with('success', 'Bourse supprimée.');
    }
}

