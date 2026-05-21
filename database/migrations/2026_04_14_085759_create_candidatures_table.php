<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->string('email')->unique();
        $table->string('telephone')->nullable();
        $table->string('nationalite')->nullable();
        $table->string('diplome_obtenu');
        $table->string('etablissement_origine');
        $table->string('specialite_souhaitee');
        $table->text('projet_recherche')->nullable();
        $table->string('directeur_souhaite')->nullable();
        $table->string('dossier_fichier')->nullable(); // ZIP ou PDF
        $table->enum('statut', ['soumise', 'en_examen', 'acceptee', 'rejetee'])->default('soumise');
        $table->text('commentaire_admin')->nullable();
        $table->year('annee_candidature');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
