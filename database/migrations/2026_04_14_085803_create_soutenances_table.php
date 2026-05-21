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
        Schema::create('soutenances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('these_id')->constrained()->onDelete('cascade');
        $table->foreignId('doctorant_id')->constrained()->onDelete('cascade');
        $table->date('date');
        $table->time('heure');
        $table->string('lieu');
        $table->text('jury')->nullable(); // JSON ou texte des membres du jury
        $table->enum('statut', ['programmee', 'realisee', 'reportee'])->default('programmee');
        $table->string('mention')->nullable(); // Très honorable, Honorable...
        $table->boolean('publique')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soutenances');
    }
};
