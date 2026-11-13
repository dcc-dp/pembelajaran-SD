<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langganan extends Model
{
    use HasFactory;

    protected $table = 'langganan';

    protected $fillable = [
        'user_id',
        'paket_langganan_id',
        'tanggal_mulai',
        'tanggal_berakhir',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
    ];

    public const STATUS_AKTIF = 'aktif';
    public const STATUS_BERAKHIR = 'berakhir';
    public const STATUS_DIBATALKAN = 'dibatalkan';

    /**
     * Batas maksimal sisa hari agar paket dapat diperpanjang (H-7 sebelum masa aktif berakhir).
     */
    public const BATAS_HARI_PERPANJANG = 7;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paketLangganan()
    {
        return $this->belongsTo(PaketLangganan::class, 'paket_langganan_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'langganan_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', self::STATUS_AKTIF);
    }

    /**
     * Mengecek apakah langganan ini sedang aktif dan sudah lunas.
     */
    public function isAktif(): bool
    {
        if ($this->status !== self::STATUS_AKTIF || ! $this->tanggal_berakhir) {
            return false;
        }

        if ($this->tanggal_berakhir->lt(Carbon::today())) {
            return false;
        }

        if ($this->relationLoaded('pembayarans')) {
            return $this->pembayarans->contains('status', Pembayaran::STATUS_BERHASIL);
        }

        return $this->pembayarans()->where('status', Pembayaran::STATUS_BERHASIL)->exists();
    }

    /**
     * Menghitung sisa hari masa aktif langganan dari hari ini.
     */
    public function sisaHari(): int
    {
        if (! $this->tanggal_berakhir || $this->tanggal_berakhir->lt(Carbon::today())) {
            return 0;
        }

        return (int) max(0, Carbon::today()->diffInDays($this->tanggal_berakhir, false));
    }

    /**
     * Mengecek apakah langganan ini sudah masuk periode perpanjangan (H-7 atau sudah berakhir).
     */
    public function bisaDiperpanjang(): bool
    {
        if (! $this->isAktif()) {
            return true;
        }

        return $this->sisaHari() <= self::BATAS_HARI_PERPANJANG;
    }
}
