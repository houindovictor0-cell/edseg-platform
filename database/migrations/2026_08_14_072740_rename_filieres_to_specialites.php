<?php
// database/migrations/2026_08_13_000002_rename_filieres_to_specialites.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('filieres', 'specialites');

        Schema::table('specialites', function (Blueprint $table) {
            $table->foreignId('mention_id')->nullable()->after('id')
                  ->constrained('mentions')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('specialites', function (Blueprint $table) {
            $table->dropForeign(['mention_id']);
            $table->dropColumn('mention_id');
        });
        Schema::rename('specialites', 'filieres');
    }
};

