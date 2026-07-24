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
        Schema::create('enseignants', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
    ->nullable()
    ->constrained()
    ->nullOnDelete();


   $table->string('matricule')->nullable()->unique();
    $table->string('nom');
    $table->string('prenom');
    $table->string('telephone')->nullable();
    $table->string('photo')->nullable();

    $table->string('grade');
    $table->string('specialite');

    // Nouvelles colonnes
    $table->string('etablissement')->nullable();
    $table->boolean('est_directeur_these')->default(false);
    $table->integer('quota_theses')->default(5);
    $table->string('option')->nullable();
    $table->string('provenance')->nullable();
$table->string('pays')->nullable();
    $table->text('biographie')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};

