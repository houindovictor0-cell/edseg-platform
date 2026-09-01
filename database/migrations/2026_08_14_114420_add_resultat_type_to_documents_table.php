
<?php
// database/migrations/2026_08_13_000003_add_resultat_type_to_documents.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->enum('categorie', ['formulaire', 'guide', 'charte', 'rapport', 'resultat', 'autre'])
                ->default('autre')->change();
            $table->enum('type_resultat', ['preselection', 'test_prepa', 'annuel'])
                ->nullable()->after('categorie');
            $table->string('annee', 9)->nullable()->after('type_resultat');
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['type_resultat', 'annee']);
            $table->enum('categorie', ['formulaire', 'guide', 'charte', 'rapport', 'autre'])
                ->default('autre')->change();
        });
    }
};
