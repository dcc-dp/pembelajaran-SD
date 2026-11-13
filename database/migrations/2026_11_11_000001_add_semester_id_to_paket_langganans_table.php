<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambahkan kolom semester_id ke tabel paket_langganans jika belum ada
        if (!Schema::hasColumn('paket_langganans', 'semester_id')) {
            Schema::table('paket_langganans', function (Blueprint $table) {
                $table->foreignId('semester_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('semesters')
                    ->nullOnDelete();
            });
        }

        // 2. Ambil ID Semester 1 dan Semester 2
        $sem1 = DB::table('semesters')->where('nama', 'like', '%1%')->orderBy('urutan')->first();
        $sem2 = DB::table('semesters')->where('nama', 'like', '%2%')->orderBy('urutan')->first();

        if ($sem1 && $sem2) {
            // Bersihkan paket yang ada atau perbarui menjadi 2 paket terpisah:
            // Paket 1: Kelas 1-6 Semester 1
            // Paket 2: Kelas 1-6 Semester 2
            $firstPaket = DB::table('paket_langganans')->orderBy('id')->first();
            if ($firstPaket) {
                DB::table('paket_langganans')->where('id', $firstPaket->id)->update([
                    'semester_id' => $sem1->id,
                    'nama' => 'Paket Semester 1 (Kelas 1–6 SD)',
                    'deskripsi' => 'Akses lengkap ke seluruh perangkat ajar, modul ajar, bank soal, dan administrasi guru Kelas 1 sampai Kelas 6 untuk Semester 1 selama 12 bulan.',
                    'harga' => 150000.00,
                    'durasi_bulan' => 12,
                    'status' => 'aktif',
                    'updated_at' => now(),
                ]);

                // Buat atau perbarui paket kedua untuk Semester 2
                $secondPaket = DB::table('paket_langganans')->where('id', '!=', $firstPaket->id)->first();
                if ($secondPaket) {
                    DB::table('paket_langganans')->where('id', $secondPaket->id)->update([
                        'semester_id' => $sem2->id,
                        'nama' => 'Paket Semester 2 (Kelas 1–6 SD)',
                        'deskripsi' => 'Akses lengkap ke seluruh perangkat ajar, modul ajar, bank soal, dan administrasi guru Kelas 1 sampai Kelas 6 untuk Semester 2 selama 12 bulan.',
                        'harga' => 150000.00,
                        'durasi_bulan' => 12,
                        'status' => 'aktif',
                        'updated_at' => now(),
                    ]);
                } else {
                    DB::table('paket_langganans')->insert([
                        'semester_id' => $sem2->id,
                        'nama' => 'Paket Semester 2 (Kelas 1–6 SD)',
                        'deskripsi' => 'Akses lengkap ke seluruh perangkat ajar, modul ajar, bank soal, dan administrasi guru Kelas 1 sampai Kelas 6 untuk Semester 2 selama 12 bulan.',
                        'harga' => 150000.00,
                        'durasi_bulan' => 12,
                        'status' => 'aktif',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                DB::table('paket_langganans')->insert([
                    [
                        'semester_id' => $sem1->id,
                        'nama' => 'Paket Semester 1 (Kelas 1–6 SD)',
                        'deskripsi' => 'Akses lengkap ke seluruh perangkat ajar, modul ajar, bank soal, dan administrasi guru Kelas 1 sampai Kelas 6 untuk Semester 1 selama 12 bulan.',
                        'harga' => 150000.00,
                        'durasi_bulan' => 12,
                        'status' => 'aktif',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'semester_id' => $sem2->id,
                        'nama' => 'Paket Semester 2 (Kelas 1–6 SD)',
                        'deskripsi' => 'Akses lengkap ke seluruh perangkat ajar, modul ajar, bank soal, dan administrasi guru Kelas 1 sampai Kelas 6 untuk Semester 2 selama 12 bulan.',
                        'harga' => 150000.00,
                        'durasi_bulan' => 12,
                        'status' => 'aktif',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('paket_langganans', 'semester_id')) {
            Schema::table('paket_langganans', function (Blueprint $table) {
                if (DB::getDriverName() !== 'sqlite') {
                    $table->dropForeign(['semester_id']);
                }
                $table->dropColumn('semester_id');
            });
        }
    }
};

