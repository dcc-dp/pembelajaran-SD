<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Lepaskan ketergantungan paket langganan dari kelas_id
        if (DB::getDriverName() !== 'sqlite') {
            if (Schema::hasColumn('paket_langganans', 'kelas_id')) {
                Schema::table('paket_langganans', function (Blueprint $table) {
                    $table->dropForeign(['kelas_id']);
                    $table->dropColumn('kelas_id');
                });
            }
        }

        // 2. Semua materi repository diubah menjadi premium
        if (Schema::hasTable('repositories') && Schema::hasColumn('repositories', 'akses')) {
            DB::table('repositories')->update(['akses' => 'premium']);
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('paket_langganans', 'kelas_id')) {
            Schema::table('paket_langganans', function (Blueprint $table) {
                $table->foreignId('kelas_id')->nullable()->constrained('kelas');
            });
        }
    }
};
