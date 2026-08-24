<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            // SQLite has no native enum constraint to alter; nothing to do.
            return;
        }

        DB::statement("UPDATE doctorants SET statut = 'actif' WHERE statut IN ('inscrit','en_redaction')");
        DB::statement("UPDATE doctorants SET statut = 'diplome' WHERE statut = 'soutenu'");
        DB::statement("UPDATE doctorants SET statut = 'abandon' WHERE statut = 'abandonne'");
        DB::statement("ALTER TABLE doctorants MODIFY statut ENUM('actif','suspendu','diplome','abandon') NOT NULL DEFAULT 'actif'");
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("UPDATE doctorants SET statut = 'inscrit' WHERE statut = 'actif'");
        DB::statement("UPDATE doctorants SET statut = 'soutenu' WHERE statut = 'diplome'");
        DB::statement("UPDATE doctorants SET statut = 'abandonne' WHERE statut = 'abandon'");
        DB::statement("ALTER TABLE doctorants MODIFY statut ENUM('inscrit','en_redaction','soutenu','abandonne') NOT NULL DEFAULT 'inscrit'");
    }
};
