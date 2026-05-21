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
    Schema::table('theses', function (Blueprint $table) {
        $table->string('mention')->nullable()->after('date_soutenance');
        $table->text('jury')->nullable()->after('mention');
        $table->string('etablissement_cotutelle')->nullable()->after('jury');
    });
}
public function down(): void
{
    Schema::table('theses', function (Blueprint $table) {
        $table->dropColumn(['mention','jury','etablissement_cotutelle']);
    });
}
};

