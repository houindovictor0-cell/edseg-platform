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
    Schema::table('seminaires', function (Blueprint $table) {
        $table->string('affiche')->nullable()->after('titre');
    });
}
public function down(): void
{
    Schema::table('seminaires', function (Blueprint $table) {
        $table->dropColumn('affiche');
    });
}
};
