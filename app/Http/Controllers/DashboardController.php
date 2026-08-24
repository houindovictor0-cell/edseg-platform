<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Mail\CompteApprouve;
use App\Mail\CompteRejete;
use App\Mail\CandidatureAcceptee;
use App\Mail\CandidatureRejetee;
use App\Models\ActivityLog;
use App\Models\Candidature;
use App\Models\Publication;
use App\Models\These;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Enseignant;
use App\Models\Partenaire;
class DashboardController extends Controller
{
    // ── ROUTEUR PRINCIPAL ────────────────────────────────────────────────────

    public function index()
    {
        return redirect()->route('admin.index');
    }

    // ── ADMIN ────────────────────────────────────────────────────────────────

    public function admin()
{
    $stats = [
        'doctorants'    => \App\Models\Doctorant::count(),
        'theses'        => These::count(),
        'candidatures'  => Candidature::where('statut', 'soumise')->count(),
        'utilisateurs'  => User::count(),
        'encadreurs'    => Enseignant::where('est_directeur_these', true)->count(),
        'programmes'    => \App\Models\Specialite::count(),
        'partenariats'  => \App\Models\Partenaire::where('portee', 'international')->count(),
        'projets'       => \App\Models\ProjetRecherche::where('statut', 'en_cours')->count(),
        'publications'  => Publication::count(),
    ];

    $activites = ActivityLog::with('user')
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

    $candidaturesRecentes = Candidature::orderBy('created_at', 'desc')->take(5)->get();

    // Évolution des doctorants par année d'inscription
    $evolutionDoctorants = \App\Models\Doctorant::selectRaw('annee_inscription, COUNT(*) as total')
        ->whereNotNull('annee_inscription')
        ->groupBy('annee_inscription')
        ->orderBy('annee_inscription')
        ->get();

    // Répartition des doctorants par spécialité (top 6)
    $repartitionSpecialites = \App\Models\Doctorant::selectRaw('specialite, COUNT(*) as total')
        ->whereNotNull('specialite')
        ->groupBy('specialite')
        ->orderByDesc('total')
        ->take(6)
        ->get();

    return view('dashboard.admin', compact(
        'stats', 'activites', 'candidaturesRecentes',
        'evolutionDoctorants', 'repartitionSpecialites'
    ));
}



    public function candidatures()
    {
        $query = Candidature::orderBy('created_at', 'desc');
        if (request('statut')) {
            $query->where('statut', request('statut'));
        }
        $candidatures = $query->paginate(15);
        return view('dashboard.admin-candidatures', compact('candidatures'));
    }

    public function traiterCandidature(Request $request, $id)
    {
        $request->validate([
            'statut'            => 'required|in:acceptee,rejetee,en_examen,soumise',
            'commentaire_admin' => 'nullable|string',
        ]);

        $candidature  = Candidature::findOrFail($id);
        $ancienStatut = $candidature->statut;

        $candidature->update([
            'statut'            => $request->statut,
            'commentaire_admin' => $request->commentaire_admin,
        ]);

        Logger::log(
            "Candidature {$request->statut} — {$candidature->prenom} {$candidature->nom}",
            'Candidature',
            $id,
            $request->commentaire_admin
        );

        if ($ancienStatut !== $request->statut) {
            try {
                if ($request->statut === 'acceptee') {
                    Mail::to($candidature->email)->send(new CandidatureAcceptee($candidature));
                }
                if ($request->statut === 'rejetee') {
                    Mail::to($candidature->email)->send(new CandidatureRejetee($candidature));
                }
            } catch (\Exception $e) {
                \Log::error('Mail candidature : ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Décision enregistrée' .
            (in_array($request->statut, ['acceptee', 'rejetee']) ? ' et email envoyé.' : '.'));
    }

    public function utilisateurs()
    {
        $utilisateurs = User::with('roles')
            ->orderBy('is_approved', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('dashboard.admin-utilisateurs', compact('utilisateurs'));
    }

    public function storeUtilisateur(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'email_verified_at' => now(),
            'is_approved'       => $request->has('is_approved'),
            'approved_at'       => $request->has('is_approved') ? now() : null,
            'approved_by'       => Auth::id(),
        ]);

        $user->assignRole('admin');

        Logger::log(
            "Utilisateur créé — {$user->name}",
            'User',
            $user->id,
            "Email : {$user->email}"
        );

        if ($request->has('is_approved')) {
            try {
                Mail::to($user->email)->send(new CompteApprouve($user));
            } catch (\Exception $e) {
                \Log::error('Mail compte : ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.utilisateurs')
            ->with('success', "Compte de {$user->name} créé avec succès.");
    }

    public function approuverUtilisateur($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        Logger::log(
            "Compte approuvé — {$user->name}",
            'User',
            $user->id
        );

        try {
            Mail::to($user->email)->send(new CompteApprouve($user));
        } catch (\Exception $e) {
            \Log::error('Mail approbation : ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', "Compte de {$user->name} approuvé.");
    }

    public function rejeterUtilisateur($id)
    {
        $user = User::findOrFail($id);

        Logger::log(
            "Compte désactivé — {$user->name}",
            'User',
            $user->id
        );

        try {
            Mail::to($user->email)->send(new CompteRejete($user));
        } catch (\Exception $e) {
            \Log::error('Mail rejet : ' . $e->getMessage());
        }

        $user->update(['is_approved' => false]);

        return redirect()->back()
            ->with('success', "Compte de {$user->name} désactivé. Email envoyé.");
    }

    public function gererActualites()
    {
        $actualites = \App\Models\Actualite::orderBy('created_at', 'desc')->paginate(15);
        return view('dashboard.admin-actualites', compact('actualites'));
    }

    public function publierActualite(Request $request)
{
    $request->validate([
        'titre'     => 'required|string|max:255',
        'contenu'   => 'required|string',
        'categorie' => 'required|in:actualite,communique,offre,soutenance,colloque,bourse,mobilite',
        'image'     => 'nullable|image|max:4096',
        'document'  => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
    ]);

    $data = $request->except(['image', 'document']);

    $data['user_id'] = Auth::id();
    $data['publiee'] = true;
    $data['date_publication'] = now();

    // Upload de l'image
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')
            ->store('actualites', 'public');
    }

    // Upload du document
    if ($request->hasFile('document')) {

        $file = $request->file('document');

        // Stockage sécurisé avec nom généré par Laravel
        $data['document'] = $file->store('actualites/documents', 'public');

        // Conservation du nom original pour l'affichage
        $data['document_nom'] = $file->getClientOriginalName();
    }

    $actualite = \App\Models\Actualite::create($data);

    Logger::log(
        "Actualité publiée — {$actualite->titre}",
        'Actualite',
        $actualite->id,
        "Catégorie : {$actualite->categorie}"
    );

    return redirect()
        ->route('admin.actualites')
        ->with('success', 'Actualité publiée.');
}

}
