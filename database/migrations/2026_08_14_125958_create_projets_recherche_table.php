<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projets_recherche', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratoire_id')->constrained('laboratoires')->cascadeOnDelete();
            $table->string('titre');
            $table->text('description');
            $table->string('periode')->nullable();
            $table->string('bailleur')->nullable();
            $table->enum('statut', ['planifie', 'en_cours', 'termine'])->default('en_cours');
            $table->boolean('publie')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projets_recherche');
    }
};

