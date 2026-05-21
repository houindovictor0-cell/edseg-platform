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
    Schema::table('partenaires', function (Blueprint $table) {
        $table->string('image')->nullable()->after('nom');
        $table->text('accord')->nullable()->after('description');
        $table->date('date_accord')->nullable()->after('accord');
        $table->string('contact_nom')->nullable()->after('date_accord');
        $table->string('contact_email')->nullable()->after('contact_nom');
        $table->string('domaines_cooperation')->nullable()->after('contact_email');
    });
}
public function down(): void
{
    Schema::table('partenaires', function (Blueprint $table) {
        $table->dropColumn(['image','accord','date_accord','contact_nom','contact_email','domaines_cooperation']);
    });
}
};
