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
    Schema::table('bourses', function (Blueprint $table) {
        $table->string('fichier')->nullable()->after('lien_candidature');
        $table->string('image')->nullable()->after('titre');
        $table->text('eligibilite')->nullable()->after('description');
        $table->string('duree')->nullable()->after('montant');
    });
}
public function down(): void
{
    Schema::table('bourses', function (Blueprint $table) {
        $table->dropColumn(['fichier', 'image', 'eligibilite', 'duree']);
    });
}

};
