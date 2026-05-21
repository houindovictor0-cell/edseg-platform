<?php
namespace App\Http\Controllers;
use App\Models\Partenaire;
use App\Models\Bourse;

class CooperationController extends Controller
{
    public function national()
    {
        $partenaires = Partenaire::where('portee', 'national')->get();
        return view('pages.cooperation.national', compact('partenaires'));
    }

    public function international()
    {
        $partenaires = Partenaire::where('portee', 'international')->get();
        return view('pages.cooperation.international', compact('partenaires'));
    }

    public function partenaire($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $autres = Partenaire::where('id', '!=', $id)
            ->where('portee', $partenaire->portee)
            ->take(3)->get();
        return view('pages.cooperation.partenaire-detail', compact('partenaire', 'autres'));
    }

    public function mobilite()
    {
        $bourses = Bourse::where('active', true)->orderBy('date_limite')->get();
        return view('pages.cooperation.mobilite', compact('bourses'));
    }
}
