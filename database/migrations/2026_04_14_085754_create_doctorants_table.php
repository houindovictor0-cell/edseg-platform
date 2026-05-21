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
     Schema::create('doctorants', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('matricule')->unique();
        $table->string('nom');
        $table->string('prenom');
        $table->string('telephone')->nullable();
        $table->string('nationalite')->nullable();
        $table->string('photo')->nullable();
        $table->string('specialite');
        $table->string('titre_these')->nullable();
        $table->foreignId('directeur_id')->nullable()->constrained('enseignants')->onDelete('set null');
        $table->enum('statut', ['inscrit', 'en_redaction', 'soutenu', 'abandonne'])->default('inscrit');
        $table->year('annee_inscription');
        $table->date('date_soutenance_prevue')->nullable();
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctorants');
    }
};
