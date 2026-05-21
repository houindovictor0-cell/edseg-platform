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
        Schema::create('seminaires', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description')->nullable();
        $table->string('intervenant')->nullable();
        $table->string('etablissement_intervenant')->nullable();
        $table->date('date');
        $table->time('heure_debut');
        $table->time('heure_fin');
        $table->string('lieu');
        $table->string('fichier_support')->nullable();
        $table->string('compte_rendu')->nullable();
        $table->enum('statut', ['a_venir', 'termine', 'annule'])->default('a_venir');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminaires');
    }
};
