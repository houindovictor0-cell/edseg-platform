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
    Schema::create('axes_recherche', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description');
        $table->text('mots_cles')->nullable();
        $table->boolean('actif')->default(true);
        $table->integer('ordre')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('axes_recherche');
    }
};
