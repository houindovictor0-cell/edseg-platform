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
        Schema::create('rapports_avancement', function (Blueprint $table) {
        $table->id();
        $table->foreignId('doctorant_id')->constrained()->onDelete('cascade');
        $table->foreignId('these_id')->constrained()->onDelete('cascade');
        $table->string('titre');
        $table->text('contenu')->nullable();
        $table->string('fichier')->nullable();
        $table->enum('statut', ['soumis', 'en_revision', 'valide', 'rejete'])->default('soumis');
        $table->text('commentaire_directeur')->nullable();
        $table->timestamp('date_soumission')->nullable();
        $table->timestamp('date_validation')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports_avancement');
    }
};
