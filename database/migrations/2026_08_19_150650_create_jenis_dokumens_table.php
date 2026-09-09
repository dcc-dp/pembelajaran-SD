<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_dokumen_id')
                ->constrained('kategori_dokumens')
                ->cascadeOnDelete();

            $table->string('nama', 100);
            $table->text('deskripsi')->nullable();
            $table->tinyInteger('urutan');
            $table->enum('status', ['aktif', 'tidak_aktif']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_dokumens');
    }
};