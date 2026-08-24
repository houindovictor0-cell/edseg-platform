<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::table('doctorants', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
            Schema::table('doctorants', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            });
            return;
        }

        DB::statement('ALTER TABLE doctorants DROP FOREIGN KEY doctorants_user_id_foreign');
        DB::statement('ALTER TABLE doctorants MODIFY user_id BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE doctorants ADD CONSTRAINT doctorants_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL');
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::table('doctorants', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
            Schema::table('doctorants', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            });
            return;
        }

        DB::statement('ALTER TABLE doctorants DROP FOREIGN KEY doctorants_user_id_foreign');
        DB::statement('ALTER TABLE doctorants MODIFY user_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE doctorants ADD CONSTRAINT doctorants_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
    }
};
