<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'nama',
    'nama_sekolah',
    'email',
    'no_hp',
    'foto',
    'password'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get avatar photo URL with fallback.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->foto)) {
            return \Illuminate\Support\Facades\Storage::url($this->foto);
        }

        return asset('assets/admin/img/user.jpg');
    }

    /**
     * Compatibility accessor for templates using ->name instead of ->nama.
     */
    public function getNameAttribute(): ?string
    {
        return $this->nama;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function langganans()
    {
        return $this->hasMany(Langganan::class, 'user_id');
    }

    public function riwayatUnduhan()
    {
        return $this->hasMany(RiwayatUnduhan::class, 'user_id');
    }

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'user_id');
    }

    /**
     * Memeriksa apakah user memiliki langganan aktif:
     * - Jika $semesterId diberikan, memeriksa apakah paket aktif mencakup semester tersebut.
     * - Super Admin selalu memiliki akses penuh.
     */
    public function hasActiveSubscription(?int $semesterId = null): bool
    {
        if ($this->hasRole('Super Admin')) {
            return true;
        }

        $query = $this->langganans()
            ->where('status', Langganan::STATUS_AKTIF)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_berakhir', '>=', now())
            ->where(function ($q) {
                $q->whereHas('pembayarans', fn($p) => $p->where('status', Pembayaran::STATUS_BERHASIL))
                  ->orWhereDoesntHave('pembayarans');
            });

        if ($semesterId !== null) {
            $query->whereHas('paketLangganan', function ($q) use ($semesterId) {
                $q->where(function ($sub) use ($semesterId) {
                    $sub->whereNull('semester_id')
                        ->orWhere('semester_id', $semesterId);
                });
            });
        }

        return $query->exists();
    }

    /**
     * Memeriksa apakah user berhak mengakses dokumen repository:
     * - Super Admin selalu memiliki akses penuh.
     * - Semua materi bersifat premium, sehingga guru wajib memiliki paket aktif untuk semester dokumen tersebut.
     * - Paket mencakup seluruh Kelas 1-6 untuk semester bersangkutan.
     */
    public function canAccessRepository(Repository $repository): bool
    {
        if ($this->hasRole('Super Admin')) {
            return true;
        }

        return $this->hasActiveSubscription($repository->semester_id);
    }

    /**
     * Mengambil ID semester yang sedang aktif dilanggani oleh guru.
     *
     * @return array<int>
     */
    public function getActiveSubscribedSemesterIds(): array
    {
        if ($this->hasRole('Super Admin')) {
            return Semester::pluck('id')->toArray();
        }

        return $this->langganans()
            ->where('status', Langganan::STATUS_AKTIF)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_berakhir', '>=', now())
            ->where(function ($query) {
                $query->whereHas('pembayarans', fn($p) => $p->where('status', Pembayaran::STATUS_BERHASIL))
                      ->orWhereDoesntHave('pembayarans');
            })
            ->with('paketLangganan')
            ->get()
            ->map(function ($l) {
                if ($l->paketLangganan && $l->paketLangganan->semester_id) {
                    return [$l->paketLangganan->semester_id];
                }
                return Semester::pluck('id')->toArray();
            })
            ->flatten()
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * Mengambil daftar ID kelas yang sedang aktif dilanggani oleh pengguna.
     * Karena paket mencakup seluruh Kelas 1-6, jika memiliki paket aktif maka seluruh kelas aktif.
     *
     * @return array<int>
     */
    public function getActiveSubscribedKelasIds(): array
    {
        if ($this->hasRole('Super Admin') || $this->hasActiveSubscription()) {
            return Kelas::pluck('id')->toArray();
        }

        return [];
    }

    /**
     * Mengambil langganan aktif pengguna yang berlaku saat ini (opsional untuk semester tertentu).
     */
    public function getActiveSubscription(?int $semesterId = null): ?Langganan
    {
        $query = $this->langganans()
            ->where('status', Langganan::STATUS_AKTIF)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_berakhir', '>=', now())
            ->where(function ($query) {
                $query->whereHas('pembayarans', fn($p) => $p->where('status', Pembayaran::STATUS_BERHASIL))
                      ->orWhereDoesntHave('pembayarans');
            });

        if ($semesterId !== null) {
            $query->whereHas('paketLangganan', function ($q) use ($semesterId) {
                $q->where(function ($sub) use ($semesterId) {
                    $sub->whereNull('semester_id')
                        ->orWhere('semester_id', $semesterId);
                });
            });
        }

        return $query->latest('tanggal_berakhir')->first();
    }

    /**
     * Mengambil tanggal berakhir terjauh dari langganan aktif/mendatang (opsional untuk semester tertentu).
     */
    public function getLatestSubscriptionEndDate(?int $semesterId = null): ?\Carbon\Carbon
    {
        $query = $this->langganans()
            ->where('status', Langganan::STATUS_AKTIF)
            ->whereDate('tanggal_berakhir', '>=', now())
            ->where(function ($query) {
                $query->whereHas('pembayarans', fn($p) => $p->where('status', Pembayaran::STATUS_BERHASIL))
                      ->orWhereDoesntHave('pembayarans');
            });

        if ($semesterId !== null) {
            $query->whereHas('paketLangganan', function ($q) use ($semesterId) {
                $q->where(function ($sub) use ($semesterId) {
                    $sub->whereNull('semester_id')
                        ->orWhere('semester_id', $semesterId);
                });
            });
        }

        $latest = $query->max('tanggal_berakhir');

        return $latest ? \Carbon\Carbon::parse($latest) : null;
    }

    /**
     * Menghitung total sisa hari masa aktif terjauh untuk semester tertentu.
     */
    public function getSisaHariSemester(?int $semesterId = null): int
    {
        $latestEnd = $this->getLatestSubscriptionEndDate($semesterId);
        if (! $latestEnd || $latestEnd->lt(\Carbon\Carbon::today())) {
            return 0;
        }

        return (int) max(0, \Carbon\Carbon::today()->diffInDays($latestEnd, false));
    }

    /**
     * Mengecek apakah paket untuk semester tertentu dapat dibeli/diperpanjang:
     * - Dapat dibeli jika belum aktif, sudah berakhir, atau sisa masa aktif <= 7 hari (H-7).
     */
    public function canRenewSemester(?int $semesterId = null): bool
    {
        $latestEnd = $this->getLatestSubscriptionEndDate($semesterId);
        if (! $latestEnd) {
            return true;
        }

        $sisaHari = (int) \Carbon\Carbon::today()->diffInDays($latestEnd, false);

        return $sisaHari <= Langganan::BATAS_HARI_PERPANJANG;
    }
}
