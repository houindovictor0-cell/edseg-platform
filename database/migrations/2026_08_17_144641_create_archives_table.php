<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->morphs('archivable'); // archivable_id + archivable_type (Doctorant ou Enseignant)
            $table->string('titre');
            $table->enum('type', ['these', 'publication', 'distinction', 'rapport', 'note', 'autre'])->default('note');
            $table->text('description')->nullable();
            $table->date('date_evenement')->nullable();
            $table->string('fichier')->nullable();
            $table->foreignId('cree_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};

