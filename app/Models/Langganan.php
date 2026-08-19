<?php

namespace App\Models;

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
}