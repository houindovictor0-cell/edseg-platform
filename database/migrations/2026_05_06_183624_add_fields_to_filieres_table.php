<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('filieres', function (Blueprint $table) {
            $table->string('image')->nullable()->after('nom');
            $table->text('accroche')->nullable()->after('description');
            $table->text('conditions_acces')->nullable()->after('debouches');
            $table->text('programme')->nullable()->after('conditions_acces');
            $table->text('competences')->nullable()->after('programme');
            $table->string('responsable')->nullable()->after('competences');
            $table->string('email_responsable')->nullable()->after('responsable');
            $table->boolean('publiee')->default(true)->after('active');
        });
    }

    public function down(): void
    {
        Schema::table('filieres', function (Blueprint $table) {
            $table->dropColumn([
                'image', 'accroche', 'conditions_acces',
                'programme', 'competences', 'responsable',
                'email_responsable', 'publiee'
            ]);
        });
    }
};

