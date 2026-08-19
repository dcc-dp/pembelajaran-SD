<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'langganan_id',
        'metode_pembayaran',
        'jumlah',
        'tanggal_pembayaran',
        'bukti_pembayaran',
        'status',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_pembayaran' => 'datetime',
    ];

    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_BERHASIL = 'berhasil';
    public const STATUS_GAGAL = 'gagal';

    public function langganan()
    {
        return $this->belongsTo(Langganan::class, 'langganan_id');
    }

    public function scopeBerhasil($query)
    {
        return $query->where('status', self::STATUS_BERHASIL);
    }

    public function scopeMenunggu($query)
    {
        return $query->where('status', self::STATUS_MENUNGGU);
    }
}