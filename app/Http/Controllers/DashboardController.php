<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Mail\CompteApprouve;
use App\Mail\CompteRejete;
use App\Mail\CandidatureAcceptee;
use App\Mail\CandidatureRejetee;
use App\Models\ActivityLog;
use App\Models\Candidature;
use App\Models\Message;
use App\Models\Publication;
use App\Models\RapportAvancement;
use App\Models\These;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Enseignant;
use App\Models\Doctorant;
use App\Models\Partenaire;
class DashboardController extends Controller
{
    // ── ROUTEUR PRINCIPAL ────────────────────────────────────────────────────

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.index');
        }

        if ($user->hasRole('enseignant')) {
            $enseignant  = $user->enseignant;
            $theses      = These::where('directeur_id', $enseignant?->id)->get();
            $publications = Publication::where('enseignant_id', $enseignant?->id)->get();
            return view('dashboard.enseignant', compact('enseignant', 'theses', 'publications'));
        }

        $doctorant = $user->doctorant;
        $these     = These::where('doctorant_id', $doctorant?->id)->first();
        $rapports  = RapportAvancement::where('doctorant_id', $doctorant?->id)
                        ->orderBy('created_at', 'desc')->get();
        $messages  = Message::where('destinataire_id', $user->id)
                        ->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard.doctorant', compact('doctorant', 'these', 'rapports', 'messages'));
    }

    // ── DOCTORANT ────────────────────────────────────────────────────────────

    public function these()
    {
        $doctorant = Auth::user()->doctorant;
        $these     = These::where('doctorant_id', $doctorant?->id)->first();
        return view('dashboard.doctorant-these', compact('these', 'doctorant'));
    }

    public function rapports()
    {
        $doctorant = Auth::user()->doctorant;
        $rapports  = RapportAvancement::where('doctorant_id', $doctorant?->id)
                        ->orderBy('created_at', 'desc')->get();
        return view('dashboard.doctorant-rapports', compact('rapports', 'doctorant'));
    }

    public function deposerRapport(Request $request)
    {
        $request->validate([
            'titre'   => 'required|string|max:255',
            'contenu' => 'nullable|string',
            'fichier' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $doctorant = Auth::user()->doctorant;
        $these     = These::where('doctorant_id', $doctorant->id)->firstOrFail();

        $data = [
            'doctorant_id'    => $doctorant->id,
            'these_id'        => $these->id,
            'titre'           => $request->titre,
            'contenu'         => $request->contenu,
            'statut'          => 'soumis',
            'date_soumission' => now(),
        ];

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('rapports', 'private');
        }

        RapportAvancement::create($data);

        Logger::log(
            "Rapport soumis — {$request->titre}",
            'RapportAvancement',
            null,
            "Doctorant : {$doctorant->prenom} {$doctorant->nom}"
        );

        return redirect()->route('doctorant.rapports')
            ->with('success', 'Rapport soumis avec succès.');
    }

    public function messages()
    {
        $messages = Message::where('destinataire_id', Auth::id())
                        ->orderBy('created_at', 'desc')->get();

        // Marquer comme lus
        Message::where('destinataire_id', Auth::id())
                ->where('lu', false)
                ->update(['lu' => true, 'date_lecture' => now()]);

        return view('dashboard.messages', compact('messages'));
    }

    public function envoyerMessage(Request $request)
    {
        $request->validate([
            'destinataire_id' => 'required|exists:users,id',
            'sujet'           => 'required|string|max:255',
            'contenu'         => 'required|string',
        ]);

        $message = Message::create([
            'expediteur_id'   => Auth::id(),
            'destinataire_id' => $request->destinataire_id,
            'sujet'           => $request->sujet,
            'contenu'         => $request->contenu,
        ]);

        $destinataire = User::find($request->destinataire_id);

        Logger::log(
            "Message envoyé — {$request->sujet}",
            'Message',
            $message->id,
            "À : {$destinataire?->name}"
        );

        return redirect()->back()->with('success', 'Message envoyé.');
    }

    // ── ENSEIGNANT ───────────────────────────────────────────────────────────

    public function thesesEncadrees()
    {
        $enseignant = Auth::user()->enseignant;
        $theses     = These::where('directeur_id', $enseignant?->id)
                        ->with('doctorant')->get();
        return view('dashboard.enseignant-theses', compact('theses', 'enseignant'));
    }

    public function publications()
    {
        $enseignant   = Auth::user()->enseignant;
        $publications = Publication::where('enseignant_id', $enseignant?->id)
                            ->orderBy('annee_publication', 'desc')->get();
        return view('dashboard.enseignant-publications', compact('publications', 'enseignant'));
    }

    public function deposerPublication(Request $request)
    {
        $request->validate([
            'titre'             => 'required|string|max:255',
            'auteurs'           => 'required|string|max:255',
            'type'              => 'required|in:article,ouvrage,chapitre,conference',
            'annee_publication' => 'required|integer|min:2000|max:2099',
            'revue'             => 'nullable|string|max:255',
            'doi'               => 'nullable|string|max:255',
            'lien_externe'      => 'nullable|url',
            'fichier'           => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $enseignant = Auth::user()->enseignant;
        $data       = $request->except('fichier');
        $data['enseignant_id'] = $enseignant->id;

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('publications', 'private');
        }

        Publication::create($data);

        Logger::log(
            "Publication déposée — {$request->titre}",
            'Publication',
            null,
            "Enseignant : {$enseignant->prenom} {$enseignant->nom}"
        );

        return redirect()->route('enseignant.publications')
            ->with('success', 'Publication ajoutée avec succès.');
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
            'role'     => 'required|in:doctorant,enseignant,admin',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'role_souhaite'     => $request->role,
            'password'          => Hash::make($request->password),
            'email_verified_at' => now(),
            'is_approved'       => $request->has('is_approved'),
            'approved_at'       => $request->has('is_approved') ? now() : null,
            'approved_by'       => Auth::id(),
        ]);

        $user->assignRole($request->role);

        Logger::log(
            "Utilisateur créé — {$user->name} ({$request->role})",
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

    // Validation du compte
    $user->update([
        'is_approved' => true,
        'approved_at' => now(),
        'approved_by' => Auth::id(),
    ]);


    // Attribution automatique du rôle Spatie
    if ($user->role_souhaite && !$user->hasRole($user->role_souhaite)) {
        $user->assignRole($user->role_souhaite);
    }


    // Création automatique du profil enseignant
    if ($user->role_souhaite === 'enseignant') {

        Enseignant::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'nom'           => $user->name,
                'prenom'        => '',
                'grade'         => 'À définir',
                'specialite'    => 'À définir',
                'etablissement' => 'À définir',
            ]
        );
    }


    // Création automatique du profil doctorant
    if ($user->role_souhaite === 'doctorant') {

        Doctorant::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'nom'    => $user->name,
                'prenom' => '',
            ]
        );
    }


    Logger::log(
        "Compte approuvé — {$user->name}",
        'User',
        $user->id,
        "Rôle : {$user->role_souhaite}"
    );


    try {
        Mail::to($user->email)->send(new CompteApprouve($user));
    } catch (\Exception $e) {
        \Log::error('Mail approbation : ' . $e->getMessage());
    }


    return redirect()->back()
        ->with('success', "Compte de {$user->name} approuvé avec profil créé.");
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

   public function changerRole(Request $request, $id)
{
    $request->validate([
        'role_souhaite' => 'required|in:doctorant,enseignant,admin'
    ]);

    $user = User::findOrFail($id);

    $ancienRole = $user->roles->first()?->name ?? 'aucun';

    // Changement du rôle Spatie
    $user->syncRoles([$request->role_souhaite]);

    // Mise à jour du rôle demandé
    $user->update([
        'role_souhaite' => $request->role_souhaite
    ]);


    // Création automatique du profil enseignant
    if ($request->role_souhaite === 'enseignant') {

        Enseignant::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nom'           => $user->name,
                'prenom'        => '',
                'grade'         => 'À définir',
                'specialite'    => 'À définir',
                'etablissement' => 'À définir',
            ]
        );
    }


    // Création automatique du profil doctorant
    if ($request->role_souhaite === 'doctorant') {

        Doctorant::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nom'    => $user->name,
                'prenom' => '',
            ]
        );
    }


    Logger::log(
        "Rôle modifié — {$user->name}",
        'User',
        $user->id,
        "Ancien : {$ancienRole} → Nouveau : {$request->role_souhaite}"
    );


    return redirect()->back()
        ->with('success', "Rôle mis à jour et profil synchronisé pour {$user->name}.");
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

