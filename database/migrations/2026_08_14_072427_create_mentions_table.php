<?php
// database/migrations/2026_08_13_000001_create_mentions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('mentions')->insert([
            ['nom' => 'Économie', 'code' => 'ECO', 'description' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Gestion',  'code' => 'GES', 'description' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('mentions');
    }
};

