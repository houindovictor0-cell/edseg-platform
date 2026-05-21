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
       Schema::create('publications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('enseignant_id')->constrained()->onDelete('cascade');
        $table->string('titre');
        $table->text('resume')->nullable();
        $table->string('auteurs');
        $table->string('revue')->nullable();
        $table->year('annee_publication');
        $table->string('doi')->nullable();
        $table->string('lien_externe')->nullable();
        $table->string('fichier')->nullable();
        $table->enum('type', ['article', 'ouvrage', 'chapitre', 'conference'])->default('article');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
