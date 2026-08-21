
<?php
// database/migrations/2026_08_13_000003_add_resultat_type_to_documents.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE documents MODIFY COLUMN categorie ENUM('formulaire','guide','charte','rapport','resultat','autre') NOT NULL DEFAULT 'autre'");

        Schema::table('documents', function (Blueprint $table) {
            $table->enum('type_resultat', ['preselection', 'test_prepa', 'annuel'])
                  ->nullable()->after('categorie');
            $table->string('annee', 9)->nullable()->after('type_resultat');
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['type_resultat', 'annee']);
        });
        DB::statement("ALTER TABLE documents MODIFY COLUMN categorie ENUM('formulaire','guide','charte','rapport','autre') NOT NULL DEFAULT 'autre'");
    }
};

