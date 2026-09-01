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
        Schema::create('seminaire_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seminaire_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->string('legende')->nullable();
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminaire_images');
    }
};
