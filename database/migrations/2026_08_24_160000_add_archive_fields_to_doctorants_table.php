<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctorants', function (Blueprint $table) {
            $table->foreignId('specialite_id')->nullable()->after('specialite')->constrained('specialites')->nullOnDelete();
            $table->string('email')->nullable()->after('telephone');
            $table->text('notes')->nullable()->after('date_soutenance_prevue');
        });
    }

    public function down(): void
    {
        Schema::table('doctorants', function (Blueprint $table) {
            $table->dropForeign(['specialite_id']);
            $table->dropColumn(['specialite_id', 'email', 'notes']);
        });
    }
};
