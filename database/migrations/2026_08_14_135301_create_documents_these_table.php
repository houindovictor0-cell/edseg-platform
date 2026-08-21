<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents_these', function (Blueprint $table) {
            $table->id();
            $table->foreignId('these_id')->constrained('theses')->cascadeOnDelete();
            $table->string('titre');
            $table->string('fichier');
            $table->enum('type', ['manuscrit', 'rapport_jury', 'autorisation', 'annexe', 'autre'])->default('autre');
            $table->boolean('visible_public')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_these');
    }
};

