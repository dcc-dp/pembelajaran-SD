<?php

namespace Tests\Feature;

use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\Kelas;
use App\Models\Kurikulum;
use App\Models\Langganan;
use App\Models\MataPelajaran;
use App\Models\PaketLangganan;
use App\Models\Pembayaran;
use App\Models\Repository;
use App\Models\Semester;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PaketLanggananDanRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $guru;
    protected Semester $semester1;
    protected Semester $semester2;
    protected Kelas $kelas1;
    protected Kelas $kelas6;
    protected Kurikulum $kurikulum;
    protected MataPelajaran $mapel;
    protected JenisDokumen $jenisDokumen;
    protected PaketLangganan $paketSem1;
    protected PaketLangganan $paketSem2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);

        // Admin User
        $this->admin = User::create([
            'nama' => 'Super Administrator',
            'email' => 'admin@test.com',
            'no_hp' => '08111111111',
            'password' => bcrypt('password'),
        ]);
        $this->admin->assignRole('Super Admin');

        // Guru User
        $this->guru = User::create([
            'nama' => 'Bapak Guru Budi',
            'nama_sekolah' => 'SD Negeri 01 Pagi',
            'email' => 'budi@test.com',
            'no_hp' => '08222222222',
            'password' => bcrypt('password'),
        ]);
        $this->guru->assignRole('Guru');

        // Semesters
        $this->semester1 = Semester::firstOrCreate(
            ['urutan' => 1],
            ['nama' => 'Semester 1', 'status' => 'aktif']
        );
        $this->semester2 = Semester::firstOrCreate(
            ['urutan' => 2],
            ['nama' => 'Semester 2', 'status' => 'aktif']
        );

        // Kelas
        $this->kelas1 = Kelas::firstOrCreate(
            ['urutan' => 1],
            ['nama' => 'Kelas 1', 'status' => 'aktif']
        );
        $this->kelas6 = Kelas::firstOrCreate(
            ['urutan' => 6],
            ['nama' => 'Kelas 6', 'status' => 'aktif']
        );

        // Master Data lainnya
        $this->kurikulum = Kurikulum::firstOrCreate(
            ['nama' => 'Kurikulum Merdeka'],
            ['deskripsi' => 'Kurikulum Merdeka', 'status' => 'aktif']
        );
        $kategori = KategoriDokumen::firstOrCreate(
            ['nama' => 'Perangkat Ajar'],
            ['urutan' => 1, 'status' => 'aktif']
        );
        $this->jenisDokumen = JenisDokumen::firstOrCreate(
            ['nama' => 'Modul Ajar'],
            ['kategori_dokumen_id' => $kategori->id, 'urutan' => 1, 'status' => 'aktif']
        );
        $this->mapel = MataPelajaran::firstOrCreate(
            ['nama' => 'Matematika'],
            ['urutan' => 1, 'status' => 'aktif']
        );

        // 2 Paket Langganan: Semester 1 & Semester 2 (Kelas 1–6 SD)
        $this->paketSem1 = PaketLangganan::firstOrCreate(
            ['semester_id' => $this->semester1->id],
            [
                'nama' => 'Paket Semester 1 (Kelas 1–6 SD)',
                'deskripsi' => 'Akses seluruh modul Kelas 1 s/d 6 untuk Semester 1.',
                'harga' => 150000,
                'durasi_bulan' => 12,
                'status' => 'aktif',
            ]
        );

        $this->paketSem2 = PaketLangganan::firstOrCreate(
            ['semester_id' => $this->semester2->id],
            [
                'nama' => 'Paket Semester 2 (Kelas 1–6 SD)',
                'deskripsi' => 'Akses seluruh modul Kelas 1 s/d 6 untuk Semester 2.',
                'harga' => 150000,
                'durasi_bulan' => 12,
                'status' => 'aktif',
            ]
        );
    }

    public function test_halaman_paket_langganan_menampilkan_dua_paket_semester_1_dan_semester_2(): void
    {
        $response = $this->get(route('guest.paket-langganan'));

        $response->assertStatus(200);
        $response->assertSee('Paket Semester 1 (Kelas 1–6 SD)');
        $response->assertSee('Paket Semester 2 (Kelas 1–6 SD)');
        $response->assertSee('Kelas 1 s/d 6 SD');
        $response->assertSee('12 Bulan');
    }

    public function test_semua_materi_repository_premium_dan_terkunci_tanpa_langganan(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('modul-matematika.pdf', 500, 'application/pdf');
        $path = $file->store('repositories', 'public');

        $repoSem1 = Repository::create([
            'judul' => 'Modul Matematika Sem 1 Kelas 1',
            'file' => $path,
            'nama_file' => 'modul-matematika.pdf',
            'tipe_file' => 'pdf',
            'ukuran_file' => 500000,
            'kurikulum_id' => $this->kurikulum->id,
            'semester_id' => $this->semester1->id,
            'kelas_id' => $this->kelas1->id,
            'mata_pelajaran_id' => $this->mapel->id,
            'jenis_dokumen_id' => $this->jenisDokumen->id,
            'akses' => Repository::AKSES_PREMIUM,
            'status' => 'dipublikasikan',
        ]);

        $this->assertFalse($this->guru->canAccessRepository($repoSem1));

        // Guru mencoba download tanpa langganan
        $response = $this->actingAs($this->guru)->get(route('guru.repository.download', $repoSem1));
        $response->assertSessionHas('error');
    }

    public function test_guru_dengan_paket_semester_1_hanya_dapat_mengakses_materi_semester_1(): void
    {
        Storage::fake('public');
        $file1 = UploadedFile::fake()->create('modul-sem1.pdf', 500, 'application/pdf');
        $file2 = UploadedFile::fake()->create('modul-sem2.pdf', 500, 'application/pdf');

        $path1 = $file1->store('repositories', 'public');
        $path2 = $file2->store('repositories', 'public');

        // Materi Semester 1 (Kelas 6)
        $repoSem1 = Repository::create([
            'judul' => 'Modul Matematika Sem 1 Kelas 6',
            'file' => $path1,
            'nama_file' => 'modul-sem1.pdf',
            'tipe_file' => 'pdf',
            'ukuran_file' => 500000,
            'kurikulum_id' => $this->kurikulum->id,
            'semester_id' => $this->semester1->id,
            'kelas_id' => $this->kelas6->id,
            'mata_pelajaran_id' => $this->mapel->id,
            'jenis_dokumen_id' => $this->jenisDokumen->id,
            'akses' => Repository::AKSES_PREMIUM,
            'status' => 'dipublikasikan',
        ]);

        // Materi Semester 2 (Kelas 1)
        $repoSem2 = Repository::create([
            'judul' => 'Modul Matematika Sem 2 Kelas 1',
            'file' => $path2,
            'nama_file' => 'modul-sem2.pdf',
            'tipe_file' => 'pdf',
            'ukuran_file' => 500000,
            'kurikulum_id' => $this->kurikulum->id,
            'semester_id' => $this->semester2->id,
            'kelas_id' => $this->kelas1->id,
            'mata_pelajaran_id' => $this->mapel->id,
            'jenis_dokumen_id' => $this->jenisDokumen->id,
            'akses' => Repository::AKSES_PREMIUM,
            'status' => 'dipublikasikan',
        ]);

        // Berikan langganan aktif Semester 1 dengan pembayaran terverifikasi
        $langgananSem1 = Langganan::create([
            'user_id' => $this->guru->id,
            'paket_langganan_id' => $this->paketSem1->id,
            'tanggal_mulai' => Carbon::today()->toDateString(),
            'tanggal_berakhir' => Carbon::today()->addMonths(12)->toDateString(),
            'status' => Langganan::STATUS_AKTIF,
        ]);

        Pembayaran::create([
            'langganan_id' => $langgananSem1->id,
            'metode_pembayaran' => 'Bank Transfer BCA',
            'jumlah' => $this->paketSem1->harga,
            'tanggal_pembayaran' => now(),
            'status' => Pembayaran::STATUS_BERHASIL,
        ]);

        // Cek hak akses
        $this->assertTrue($this->guru->canAccessRepository($repoSem1));
        $this->assertFalse($this->guru->canAccessRepository($repoSem2));

        // Guru dapat download materi Semester 1
        $responseSem1 = $this->actingAs($this->guru)->get(route('guru.repository.download', $repoSem1));
        $responseSem1->assertStatus(200);

        // Guru dilarang download materi Semester 2
        $responseSem2 = $this->actingAs($this->guru)->get(route('guru.repository.download', $repoSem2));
        $responseSem2->assertSessionHas('error');
    }

    public function test_akses_hanya_terbuka_setelah_pembayaran_diverifikasi_oleh_admin(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('modul.pdf', 500, 'application/pdf');
        $path = $file->store('repositories', 'public');

        $repo = Repository::create([
            'judul' => 'Modul Ajar Sem 1 Kelas 1',
            'file' => $path,
            'nama_file' => 'modul.pdf',
            'tipe_file' => 'pdf',
            'ukuran_file' => 500000,
            'kurikulum_id' => $this->kurikulum->id,
            'semester_id' => $this->semester1->id,
            'kelas_id' => $this->kelas1->id,
            'mata_pelajaran_id' => $this->mapel->id,
            'jenis_dokumen_id' => $this->jenisDokumen->id,
            'akses' => Repository::AKSES_PREMIUM,
            'status' => 'dipublikasikan',
        ]);

        // Guru mengajukan langganan
        $response = $this->actingAs($this->guru)->post(route('guru.langganan.store'), [
            'paket_langganan_id' => $this->paketSem1->id,
            'metode_pembayaran' => 'BCA Transfer',
        ]);

        $response->assertRedirect(route('guru.langganan.index'));

        $langganan = Langganan::where('user_id', $this->guru->id)->latest()->first();
        $this->assertNotNull($langganan);

        $pembayaran = Pembayaran::where('langganan_id', $langganan->id)->latest()->first();
        $this->assertEquals(Pembayaran::STATUS_MENUNGGU, $pembayaran->status);

        // Akses masih terkunci karena pembayaran belum diverifikasi
        $this->assertFalse($this->guru->fresh()->canAccessRepository($repo));

        // Admin memverifikasi pembayaran
        $responseAdmin = $this->actingAs($this->admin)->post(route('admin.pembayaran.verifikasi', $pembayaran));
        $responseAdmin->assertSessionHas('success');

        $this->assertEquals(Pembayaran::STATUS_BERHASIL, $pembayaran->fresh()->status);
        $this->assertTrue($this->guru->fresh()->canAccessRepository($repo));
    }

    public function test_perpanjangan_paket_hanya_bisa_dilakukan_pada_periode_h_minus_7_dan_masa_aktif_disambung(): void
    {
        $today = Carbon::today();

        // 1. Jika masa aktif masih panjang (> 7 hari, misal 60 hari), belum bisa diperpanjang
        $longEnd = $today->copy()->addDays(60);
        $langgananPanjang = Langganan::create([
            'user_id' => $this->guru->id,
            'paket_langganan_id' => $this->paketSem2->id,
            'tanggal_mulai' => $today->toDateString(),
            'tanggal_berakhir' => $longEnd->toDateString(),
            'status' => Langganan::STATUS_AKTIF,
        ]);

        Pembayaran::create([
            'langganan_id' => $langgananPanjang->id,
            'metode_pembayaran' => 'Otomatis',
            'jumlah' => $this->paketSem2->harga,
            'tanggal_pembayaran' => now(),
            'status' => Pembayaran::STATUS_BERHASIL,
        ]);

        $resTolak = $this->actingAs($this->guru)->post(route('guru.langganan.store'), [
            'paket_langganan_id' => $this->paketSem2->id,
        ]);
        $resTolak->assertSessionHas('error');

        // 2. Jika masa aktif sudah masuk periode H-7 (misal sisa 5 hari), dapat diperpanjang & disambung
        $firstEnd = $today->copy()->addDays(5);

        $langgananAwal = Langganan::create([
            'user_id' => $this->guru->id,
            'paket_langganan_id' => $this->paketSem1->id,
            'tanggal_mulai' => $today->copy()->subMonths(11)->toDateString(),
            'tanggal_berakhir' => $firstEnd->toDateString(),
            'status' => Langganan::STATUS_AKTIF,
        ]);

        Pembayaran::create([
            'langganan_id' => $langgananAwal->id,
            'metode_pembayaran' => 'BCA',
            'jumlah' => $this->paketSem1->harga,
            'tanggal_pembayaran' => now(),
            'status' => Pembayaran::STATUS_BERHASIL,
        ]);

        // Guru mengajukan perpanjangan Semester 1 pada H-5
        $this->actingAs($this->guru)->post(route('guru.langganan.store'), [
            'paket_langganan_id' => $this->paketSem1->id,
            'metode_pembayaran' => 'BCA Transfer',
        ]);

        $langgananBaru = Langganan::where('user_id', $this->guru->id)
            ->where('paket_langganan_id', $this->paketSem1->id)
            ->where('id', '!=', $langgananAwal->id)
            ->latest()
            ->first();

        $this->assertNotNull($langgananBaru);
        // Tanggal mulai perpanjangan harus hari setelah firstEnd
        $expectedStartDate = $firstEnd->copy()->addDay()->toDateString();
        $expectedEndDate = Carbon::parse($expectedStartDate)->addMonths(12)->toDateString();

        $this->assertEquals($expectedStartDate, $langgananBaru->tanggal_mulai->toDateString());
        $this->assertEquals($expectedEndDate, $langgananBaru->tanggal_berakhir->toDateString());

        // Admin verifikasi perpanjangan
        $pembayaranBaru = $langgananBaru->pembayarans->first();
        $this->actingAs($this->admin)->post(route('admin.pembayaran.verifikasi', $pembayaranBaru));

        $langgananBaru->refresh();
        $this->assertEquals($expectedStartDate, $langgananBaru->tanggal_mulai->toDateString());
        $this->assertEquals($expectedEndDate, $langgananBaru->tanggal_berakhir->toDateString());
    }

    public function test_akses_terkunci_kembali_jika_langganan_telah_berakhir(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('modul-expired.pdf', 500, 'application/pdf');
        $path = $file->store('repositories', 'public');

        $repo = Repository::create([
            'judul' => 'Modul Sem 1 Kelas 1',
            'file' => $path,
            'nama_file' => 'modul-expired.pdf',
            'tipe_file' => 'pdf',
            'ukuran_file' => 500000,
            'kurikulum_id' => $this->kurikulum->id,
            'semester_id' => $this->semester1->id,
            'kelas_id' => $this->kelas1->id,
            'mata_pelajaran_id' => $this->mapel->id,
            'jenis_dokumen_id' => $this->jenisDokumen->id,
            'akses' => Repository::AKSES_PREMIUM,
            'status' => 'dipublikasikan',
        ]);

        // Langganan yang masa berlakunya sudah lewat (kemarin)
        $expiredLangganan = Langganan::create([
            'user_id' => $this->guru->id,
            'paket_langganan_id' => $this->paketSem1->id,
            'tanggal_mulai' => Carbon::today()->subMonths(13)->toDateString(),
            'tanggal_berakhir' => Carbon::yesterday()->toDateString(),
            'status' => Langganan::STATUS_AKTIF,
        ]);

        Pembayaran::create([
            'langganan_id' => $expiredLangganan->id,
            'metode_pembayaran' => 'BCA',
            'jumlah' => $this->paketSem1->harga,
            'tanggal_pembayaran' => Carbon::today()->subMonths(13),
            'status' => Pembayaran::STATUS_BERHASIL,
        ]);

        // Akses harus terkunci kembali
        $this->assertFalse($this->guru->fresh()->canAccessRepository($repo));

        $response = $this->actingAs($this->guru)->get(route('guru.repository.download', $repo));
        $response->assertSessionHas('error');
    }

    public function test_halaman_langganan_saya_guru_dan_admin_dapat_dirender_dengan_data_langganan(): void
    {
        $langganan = Langganan::create([
            'user_id' => $this->guru->id,
            'paket_langganan_id' => $this->paketSem1->id,
            'tanggal_mulai' => Carbon::today()->toDateString(),
            'tanggal_berakhir' => Carbon::today()->addMonths(12)->toDateString(),
            'status' => Langganan::STATUS_AKTIF,
        ]);

        Pembayaran::create([
            'langganan_id' => $langganan->id,
            'metode_pembayaran' => 'Midtrans - QRIS',
            'jumlah' => $this->paketSem1->harga,
            'tanggal_pembayaran' => now(),
            'status' => Pembayaran::STATUS_BERHASIL,
        ]);

        // Guru mengakses halaman Langganan Saya
        $resGuru = $this->actingAs($this->guru)->get(route('guru.langganan.index'));
        $resGuru->assertStatus(200);
        $resGuru->assertSee('Selesaikan Pembayaran');

        // Admin mengakses halaman Data Langganan & Pembayaran
        $resAdminLangganan = $this->actingAs($this->admin)->get(route('admin.langganan.index'));
        $resAdminLangganan->assertStatus(200);

        $resAdminPembayaran = $this->actingAs($this->admin)->get(route('admin.pembayaran.index'));
        $resAdminPembayaran->assertStatus(200);
    }

    public function test_midtrans_callback_mengaktifkan_langganan_saat_settlement(): void
    {
        config(['services.midtrans.server_key' => 'Mid-server-test-key']);

        $this->actingAs($this->guru)->post(route('guru.langganan.store'), [
            'paket_langganan_id' => $this->paketSem1->id,
        ]);

        $pembayaran = Pembayaran::latest()->first();
        $this->assertNotNull($pembayaran);
        $this->assertNotNull($pembayaran->order_id);
        $this->assertEquals(Pembayaran::STATUS_MENUNGGU, $pembayaran->status);

        $orderId = $pembayaran->order_id;
        $statusCode = '200';
        $grossAmount = '150000.00';
        $signatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . 'Mid-server-test-key');

        $response = $this->postJson(route('midtrans.callback'), [
            'order_id' => $orderId,
            'status_code' => $statusCode,
            'gross_amount' => $grossAmount,
            'signature_key' => $signatureKey,
            'transaction_status' => 'settlement',
            'payment_type' => 'qris',
        ]);

        $response->assertStatus(200);
        $this->assertEquals(Pembayaran::STATUS_BERHASIL, $pembayaran->fresh()->status);
        $this->assertEquals('QRIS', $pembayaran->fresh()->metode_pembayaran);
        $this->assertTrue($this->guru->fresh()->hasActiveSubscription($this->semester1->id));
    }
}
