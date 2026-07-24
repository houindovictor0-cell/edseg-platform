<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\CooperationController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ChiffresController;
use App\Http\Controllers\Admin\FiliereController;
use App\Http\Controllers\Admin\RechercheAdminController;
use App\Http\Controllers\Admin\LaboratoireAdminController;
use App\Http\Controllers\Admin\PartenaireAdminController;
use App\Http\Controllers\Admin\SeminaireAdminController;
use App\Http\Controllers\Admin\BourseAdminController;
use App\Http\Controllers\Admin\TheseAdminController;
use App\Http\Controllers\Admin\EcoleAdminController;
use App\Http\Controllers\EnseignantTheseController;
use App\Http\Controllers\Admin\ActualiteController as AdminActualiteController;
// ─────────────────────────────────────────────────────────
//  PAGES PUBLIQUES
// ─────────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
// ─────────────────────────────────────────────────────────
//  ÉCOLE DOCTORALE
// ─────────────────────────────────────────────────────────
Route::prefix('ecole-doctorale')->group(function () {
    Route::get('/presentation', [PageController::class, 'presentation'])->name('ecole.presentation');
    Route::get('/missions', [PageController::class, 'missions'])->name('ecole.missions');
    Route::get('/mot-du-directeur', [PageController::class, 'motDirecteur'])->name('ecole.directeur');
    Route::get('/organisation', [PageController::class, 'organisation'])->name('ecole.organisation');
    Route::get('/partenaires', [PageController::class, 'partenaires'])->name('ecole.partenaires');
});
Route::get('/ecole/organisation', [PageController::class, 'organisation'])->name('ecole.organisation');
// ─────────────────────────────────────────────────────────
//  FORMATION
// ─────────────────────────────────────────────────────────
Route::prefix('formation')->group(function () {
    Route::get('/programme', [PageController::class, 'programme'])->name('formation.programme');
    Route::get('/encadrement', [PageController::class, 'encadrement'])->name('formation.encadrement');
    Route::get('/seminaires', [PageController::class, 'seminaires'])->name('formation.seminaires');
    Route::get('/seminaires/{id}', [PageController::class, 'seminaire'])->name('formation.seminaire');
    Route::get('/filieres', [PageController::class, 'filieres'])->name('formation.filieres');
    Route::get('/filieres/{id}', [PageController::class, 'filiere'])->name('formation.filiere');
});
// ─────────────────────────────────────────────────────────
//  ADMISSION
// ─────────────────────────────────────────────────────────
Route::prefix('admission')->group(function () {
    Route::get('/conditions', [AdmissionController::class, 'conditions'])->name('admission.conditions');
    Route::get('/candidature', [AdmissionController::class, 'candidature'])->name('admission.candidature');
    Route::post('/candidature', [AdmissionController::class, 'soumettre'])->name('admission.soumettre');
    Route::get('/calendrier', [AdmissionController::class, 'calendrier'])->name('admission.calendrier');
});
// ─────────────────────────────────────────────────────────
//  RECHERCHE
// ─────────────────────────────────────────────────────────
Route::prefix('recherche')->group(function () {
    Route::get('/axes', [RechercheController::class, 'axes'])->name('recherche.axes');
    Route::get('/laboratoires', [RechercheController::class, 'laboratoires'])->name('recherche.laboratoires');
    Route::get('/projets', [RechercheController::class, 'projets'])->name('recherche.projets');
    Route::get('/theses', [RechercheController::class, 'theses'])->name('recherche.theses');
    Route::get('/theses/{id}', [RechercheController::class, 'these'])->name('recherche.these');
    Route::get('/ethique', [RechercheController::class, 'ethique'])->name('recherche.ethique');
});
// ─────────────────────────────────────────────────────────
//  COOPÉRATION
// ─────────────────────────────────────────────────────────
Route::prefix('cooperation')->group(function () {
    Route::get('/national', [CooperationController::class, 'national'])->name('cooperation.national');
    Route::get('/international', [CooperationController::class, 'international'])->name('cooperation.international');
    Route::get('/mobilite', [CooperationController::class, 'mobilite'])->name('cooperation.mobilite');
    Route::get('/partenaire/{id}', [CooperationController::class, 'partenaire'])->name('cooperation.partenaire');
});
// ─────────────────────────────────────────────────────────
//  ACTUALITÉS
// ─────────────────────────────────────────────────────────
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('/actualites/{id}', [ActualiteController::class, 'show'])->name('actualites.show');
// ─────────────────────────────────────────────────────────
//  CONTACT
// ─────────────────────────────────────────────────────────
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'envoyerContact'])->name('contact.envoyer');
// ─────────────────────────────────────────────────────────
//  ESPACE MEMBRES
// ─────────────────────────────────────────────────────────
Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Doctorant ──
    Route::prefix('doctorant')->group(function () {
        Route::get('/these', [DashboardController::class, 'these'])->name('doctorant.these');
        Route::get('/rapports', [DashboardController::class, 'rapports'])->name('doctorant.rapports');
        Route::post('/rapports', [DashboardController::class, 'deposerRapport'])->name('doctorant.rapports.deposer');
        Route::get('/messages', [DashboardController::class, 'messages'])->name('doctorant.messages');
        Route::post('/messages', [DashboardController::class, 'envoyerMessage'])->name('doctorant.messages.envoyer');
    });

    // Enseignant ──
    Route::prefix('enseignant')->group(function () {
        Route::get('/theses', [DashboardController::class, 'thesesEncadrees'])->name('enseignant.theses');
        Route::get('/publications', [DashboardController::class, 'publications'])->name('enseignant.publications');
        Route::post('/publications', [DashboardController::class, 'deposerPublication'])->name('enseignant.publications.deposer');
    });
    
    
    //  Admin ──
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('admin.index');
        // Candidatures
        Route::get('/candidatures', [DashboardController::class, 'candidatures'])->name('admin.candidatures');
        Route::post('/candidatures/{id}', [DashboardController::class, 'traiterCandidature'])->name('admin.candidatures.traiter');
        // Utilisateurs
        Route::get('/utilisateurs', [DashboardController::class, 'utilisateurs'])->name('admin.utilisateurs');
        Route::post('/utilisateurs', [DashboardController::class, 'storeUtilisateur'])->name('admin.utilisateurs.store');
        Route::post('/utilisateurs/{id}/approuver', [DashboardController::class, 'approuverUtilisateur'])->name('admin.utilisateurs.approuver');
        Route::post('/utilisateurs/{id}/rejeter', [DashboardController::class, 'rejeterUtilisateur'])->name('admin.utilisateurs.rejeter');
        Route::post('/utilisateurs/{id}/role', [DashboardController::class, 'changerRole'])->name('admin.utilisateurs.changerRole');
        // Chiffres clés
        Route::get('/chiffres', [ChiffresController::class, 'index'])->name('admin.chiffres');
        Route::put('/chiffres', [ChiffresController::class, 'update'])->name('admin.chiffres.update');
        // Filières
        Route::get('/filieres', [FiliereController::class, 'index'])->name('admin.filieres');
        Route::post('/filieres', [FiliereController::class, 'store'])->name('admin.filieres.store');
        Route::get('/filieres/{id}/edit', [FiliereController::class, 'edit'])->name('admin.filieres.edit');
        Route::put('/filieres/{id}', [FiliereController::class, 'update'])->name('admin.filieres.update');
        Route::delete('/filieres/{id}', [FiliereController::class, 'destroy'])->name('admin.filieres.destroy');
        // Recherche
        Route::get('/recherche', [RechercheAdminController::class, 'index'])->name('admin.recherche');
        Route::post('/recherche', [RechercheAdminController::class, 'store'])->name('admin.recherche.store');
        Route::put('/recherche/{id}', [RechercheAdminController::class, 'update'])->name('admin.recherche.update');
        Route::delete('/recherche/{id}', [RechercheAdminController::class, 'destroy'])->name('admin.recherche.destroy');
        // Laboratoires
        Route::get('/laboratoires', [LaboratoireAdminController::class, 'index'])->name('admin.laboratoires');
        Route::post('/laboratoires', [LaboratoireAdminController::class, 'store'])->name('admin.laboratoires.store');
        Route::put('/laboratoires/{id}', [LaboratoireAdminController::class, 'update'])->name('admin.laboratoires.update');
        Route::delete('/laboratoires/{id}', [LaboratoireAdminController::class, 'destroy'])->name('admin.laboratoires.destroy');
        // Partenaires
        Route::get('/partenaires', [PartenaireAdminController::class, 'index'])->name('admin.partenaires');
        Route::post('/partenaires', [PartenaireAdminController::class, 'store'])->name('admin.partenaires.store');
        Route::put('/partenaires/{id}', [PartenaireAdminController::class, 'update'])->name('admin.partenaires.update');
        Route::delete('/partenaires/{id}', [PartenaireAdminController::class, 'destroy'])->name('admin.partenaires.destroy');
        // Séminaires
        Route::get('/seminaires', [SeminaireAdminController::class, 'index'])->name('admin.seminaires');
        Route::post('/seminaires', [SeminaireAdminController::class, 'store'])->name('admin.seminaires.store');
        Route::put('/seminaires/{id}', [SeminaireAdminController::class, 'update'])->name('admin.seminaires.update');
        Route::delete('/seminaires/{id}', [SeminaireAdminController::class, 'destroy'])->name('admin.seminaires.destroy');
        // Bourses
        // Bourses publiques
Route::get('/cooperation/mobilite', [CooperationController::class, 'mobilite'])->name('cooperation.mobilite');
Route::get('/cooperation/mobilite/{id}', [CooperationController::class, 'bourse'])->name('cooperation.bourse');
        Route::get('/bourses', [BourseAdminController::class, 'index'])->name('admin.bourses');
        Route::post('/bourses', [BourseAdminController::class, 'store'])->name('admin.bourses.store');
        Route::put('/bourses/{id}', [BourseAdminController::class, 'update'])->name('admin.bourses.update');
        Route::delete('/bourses/{id}', [BourseAdminController::class, 'destroy'])->name('admin.bourses.destroy');
        // Thèses
        Route::get('/theses', [TheseAdminController::class, 'index'])->name('admin.theses');
        Route::post('/theses', [TheseAdminController::class, 'store'])->name('admin.theses.store');
        Route::put('/theses/{id}', [TheseAdminController::class, 'update'])->name('admin.theses.update');
        Route::delete('/theses/{id}', [TheseAdminController::class, 'destroy'])->name('admin.theses.destroy');
        // École
        Route::get('/ecole', [EcoleAdminController::class, 'index'])->name('admin.ecole');
        Route::put('/ecole', [EcoleAdminController::class, 'update'])->name('admin.ecole.update');
        // Actualités
        Route::get('/actualites', [AdminActualiteController::class, 'index'])->name('admin.actualites');
        Route::post('/actualites', [AdminActualiteController::class, 'store'])->name('admin.actualites.publier');
        Route::get('/actualites/{id}/edit', [AdminActualiteController::class, 'edit'])->name('admin.actualites.edit');
        Route::put('/actualites/{id}', [AdminActualiteController::class, 'update'])->name('admin.actualites.update');
        Route::delete('/actualites/{id}', [AdminActualiteController::class, 'destroy'])->name('admin.actualites.destroy');
        Route::post('/actualites/{id}/toggle', [AdminActualiteController::class, 'togglePublication'])->name('admin.actualites.toggle');
    });



});

Route::get('dashboard/enseignant-theses-create',
    [EnseignantTheseController::class, 'create']
)->name('enseignant.theses.create');


Route::post('/enseignant/theses',
    [EnseignantTheseController::class, 'store']
)->name('enseignant.theses.store');


// ─────────────────────────────────────────────────────────
//  AUTH LARAVEL
// ─────────────────────────────────────────────────────────
require __DIR__.'/auth.php';
