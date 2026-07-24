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
        Schema::create('actualites', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('contenu');
        $table->string('image')->nullable();
        $table->enum('categorie', ['actualite', 'communique', 'offre', 'soutenance', 'colloque', 'bourse', 'mobilite'])->default('actualite');
        $table->boolean('publiee')->default(false);
        $table->timestamp('date_publication')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};
