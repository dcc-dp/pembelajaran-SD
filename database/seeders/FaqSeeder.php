<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
   
    public function run(): void
    {
        $faqs = [
            [
                'pertanyaan' => 'Apa itu SD Learning Center?',
                'jawaban' => 'SD Learning Center adalah platform digital penyedia perangkat ajar terstandarisasi untuk Guru Sekolah Dasar di seluruh Indonesia. Kami menyediakan ribuan Modul Ajar, Alur Tujuan Pembelajaran (ATP), Capaian Pembelajaran (CP), LKPD, instrumen asesmen, dan media ajar yang selalu selaras dengan Kurikulum Merdeka.',
                'urutan' => 1,
                'status' => 'aktif',
            ],
            [
                'pertanyaan' => 'Apa saja perangkat ajar yang tersedia?',
                'jawaban' => 'Kami menyediakan perangkat ajar lengkap untuk Kelas 1 hingga Kelas 6 SD mencakup seluruh mata pelajaran utama. Dokumen meliputi Modul Ajar/RPP, ATP, CP, Modul Projek P5, Program Semester (Prosem), Program Tahunan (Prota), Rubrik Asesmen, serta Bank Soal Evaluasi Harian, UTS, dan UAS.',
                'urutan' => 2,
                'status' => 'aktif',
            ],
            [
                'pertanyaan' => 'Apakah saya bisa melihat materi sebelum berlangganan?',
                'jawaban' => 'Ya, bapak dan ibu guru dapat mengunjungi menu Preview Materi untuk membaca pratinjau dokumen 1 halaman penuh secara gratis sebelum memutuskan untuk berlangganan.',
                'urutan' => 3,
                'status' => 'aktif',
            ],
            [
                'pertanyaan' => 'Apakah Preview Materi dapat diunduh?',
                'jawaban' => 'Dokumen pada menu Preview Materi hanya dapat dibaca melalui browser sebagai sampel kualitas. Untuk dapat mengunduh dokumen secara lengkap dalam format Word (.docx) dan PDF siap edit, Anda perlu berlangganan paket aktif.',
                'urutan' => 4,
                'status' => 'aktif',
            ],
            [
                'pertanyaan' => 'Bagaimana cara berlangganan?',
                'jawaban' => 'Cukup buka menu Paket Langganan, pilih paket yang sesuai dengan kebutuhan kelas atau durasi yang Anda inginkan, klik tombol "Pilih Paket Ini", lalu selesaikan pembayaran melalui transfer bank atau e-wallet. Akun Anda akan langsung aktif secara otomatis.',
                'urutan' => 5,
                'status' => 'aktif',
            ],
            [
                'pertanyaan' => 'Berapa lama masa langganan berlaku?',
                'jawaban' => 'Masa aktif langganan disesuaikan dengan paket yang Anda pilih: Paket Bulanan (berlaku 1 bulan / 30 hari), Paket Semester (berlaku 6 bulan / 180 hari), dan Paket Tahunan (berlaku 12 bulan / 365 hari).',
                'urutan' => 6,
                'status' => 'aktif',
            ],
            [
                'pertanyaan' => 'Apakah materi selalu diperbarui?',
                'jawaban' => 'Tentu. Seluruh perangkat ajar di SD Learning Center diperbarui secara berkala mengikuti perkembangan Capaian Pembelajaran (CP), kalender pendidikan, dan regulasi resmi terbaru dari Kemendikbudristek.',
                'urutan' => 7,
                'status' => 'aktif',
            ],
            [
                'pertanyaan' => 'Bagaimana cara mengunduh perangkat ajar?',
                'jawaban' => 'Setelah langganan aktif, login ke akun Anda dan masuk ke materi yang Anda butuhkan. Klik tombol "Download Word" untuk file yang dapat diedit atau "Download PDF" untuk cetak instan. Berkas akan langsung diunduh ke perangkat Anda.',
                'urutan' => 8,
                'status' => 'aktif',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(
                ['pertanyaan' => $faq['pertanyaan']],
                $faq
            );
        }
    }
}
