<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kurikulum_id')
                ->constrained('kurikulums');

            $table->foreignId('semester_id')
                ->constrained('semesters');

            $table->foreignId('kelas_id')
                ->constrained('kelas');

            $table->foreignId('mata_pelajaran_id')
                ->constrained('mata_pelajarans');

            $table->foreignId('jenis_dokumen_id')
                ->constrained('jenis_dokumens');

            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();

            $table->string('nama_file');
            $table->string('file');
            $table->string('tipe_file', 20);

            $table->enum('akses', [
                'gratis',
                'premium',
            ]);

            $table->enum('status', [
                'draft',
                'dipublikasikan',
                'diarsipkan',
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};