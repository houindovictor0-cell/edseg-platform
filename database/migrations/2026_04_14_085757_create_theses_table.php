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
        Schema::create('theses', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('resume')->nullable();
        $table->string('mot_cles')->nullable();
        $table->foreignId('doctorant_id')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('directeur_id')->nullable()->constrained('enseignants')->onDelete('cascade');
        $table->enum('statut', ['en_cours', 'soutenue', 'abandonnee'])->default('en_cours');
       $table->date('date_debut')->nullable();
        $table->date('date_soutenance')->nullable();
        $table->string('fichier')->nullable(); // PDF de la thèse
        $table->boolean('publiee')->default(false); // visible dans bibliothèque
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theses');
    }
};
