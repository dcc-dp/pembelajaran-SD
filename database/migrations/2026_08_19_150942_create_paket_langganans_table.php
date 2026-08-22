<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_langganans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kelas_id')
                ->constrained('kelas');

            $table->foreignId('semester_id')
                ->nullable()
                ->constrained('semesters');

            $table->string('nama', 100);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2);
            $table->unsignedSmallInteger('durasi_bulan');

            $table->enum('status', [
                'aktif',
                'tidak_aktif',
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_langganans');
    }
};