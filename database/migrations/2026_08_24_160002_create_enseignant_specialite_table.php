<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enseignant_specialite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enseignant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specialite_id')->constrained('specialites')->cascadeOnDelete();
            $table->unique(['enseignant_id', 'specialite_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enseignant_specialite');
    }
};
