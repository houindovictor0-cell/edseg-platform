<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\ChiffreCle;
use App\Models\Enseignant;
use App\Models\Mention;
use App\Models\Partenaire;
use App\Models\PhotoEcole;
use App\Models\Seminaire;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function accueil()
    {
        $actualites = Actualite::where('publiee', true)
            ->orderBy('date_publication', 'desc')
            ->take(4)->get();

        $chiffres = ChiffreCle::avecComptagesLive();

        $partenaires = Partenaire::orderBy('nom')->get();

        $photos = PhotoEcole::orderBy('ordre')->orderByDesc('id')->take(8)->get();

        $seminairesAVenir = Seminaire::where('statut', 'a_venir')
            ->orderBy('date')
            ->take(3)->get();

        return view('pages.accueil', compact('actualites', 'chiffres', 'partenaires', 'photos', 'seminairesAVenir'));
    }

    public function presentation()
    {
        $photosEngagement = PhotoEcole::orderBy('ordre')->orderByDesc('id')->take(6)->get();

        return view('pages.ecole.presentation', compact('photosEngagement'));
    }

    public function missions()
    {
        return view('pages.ecole.missions');
    }

    public function motDirecteur()
    {
        return view('pages.ecole.mot-directeur');
    }

    public function organisation()
    {
        $enseignants = Enseignant::orderBy('grade')->orderBy('nom')->get();

        return view('pages.ecole.organisation', compact('enseignants'));
    }

    public function partenaires()
    {
        $partenaires = Partenaire::all();

        return view('pages.ecole.partenaires', compact('partenaires'));
    }

    public function programme()
    {
        return view('pages.formation.programme');
    }

    public function filieres()
    {
        $mentions = Mention::with(['specialites' => function ($q) {
            $q->where('publiee', true)->where('active', true)->orderBy('nom');
        }])->orderBy('nom')->get();

        return view('pages.formation.filieres', compact('mentions'));
    }

    public function filiere($id)
    {
        $specialite = Specialite::with('mention')
            ->where('publiee', true)
            ->where('active', true)
            ->findOrFail($id);

        $autresSpecialites = Specialite::where('publiee', true)
            ->where('active', true)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();

        return view('pages.formation.filiere-detail', compact('specialite', 'autresSpecialites'));
    }

    public function encadrement()
    {
        $directeurs = Enseignant::where('est_directeur_these', true)
            ->orderByRaw("CASE
                WHEN grade LIKE '%Titulaire%' THEN 0
                WHEN grade LIKE '%Agrégé%' THEN 1
                ELSE 2 END")
            ->orderBy('nom')
            ->get();

        return view('pages.formation.encadrement', compact('directeurs'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function seminaires()
    {
        $seminaires = Seminaire::orderBy('date', 'desc')->get();

        return view('pages.formation.seminaires', compact('seminaires'));
    }

    public function seminaire($id)
    {
        $seminaire = Seminaire::with('images')->findOrFail($id);

        $prochains = Seminaire::where('statut', 'a_venir')
            ->where('id', '!=', $id)
            ->orderBy('date')
            ->take(3)
            ->get();

        return view('pages.formation.seminaire-details', compact('seminaire', 'prochains'));
    }

    public function envoyerContact(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'email' => 'required|email',
            'sujet' => 'required|string|max:200',
            'message' => 'required|string|min:20',
        ]);

        try {
            Mail::raw(
                "Message de : {$request->nom} ({$request->email})\n\nSujet : {$request->sujet}\n\n{$request->message}",
                function ($m) use ($request) {
                    $m->to(config('mail.from.address'))
                        ->subject("Contact ED-SEG — {$request->sujet}");
                }
            );
        } catch (\Exception $e) {
        }

        return redirect()->back()->with('success', 'Votre message a été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }
}
