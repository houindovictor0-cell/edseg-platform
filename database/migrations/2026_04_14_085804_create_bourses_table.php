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
       Schema::create('bourses', function (Blueprint $table) 
       {
        $table->id();
        $table->string('titre');
        $table->text('description');
        $table->string('organisme');
        $table->string('pays')->nullable();
        $table->decimal('montant', 10, 2)->nullable();
        $table->date('date_limite');
        $table->string('lien_candidature')->nullable();
        $table->enum('type', ['mobilite', 'recherche', 'formation', 'autre'])->default('recherche');
        $table->boolean('active')->default(true);
        $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bourses');
    }
};
