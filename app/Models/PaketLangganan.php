<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLangganan extends Model
{
    use HasFactory;

    protected $table = 'paket_langganans';

    protected $fillable = [
        'kelas_id',
        'semester_id',
        'nama',
        'deskripsi',
        'harga',
        'durasi_bulan',
        'status',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Nullable: null berarti paket berlaku untuk semua semester (full tahun).
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function langganans()
    {
        return $this->hasMany(Langganan::class, 'paket_langganan_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}