<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLangganan extends Model
{
    use HasFactory;

    protected $table = 'paket_langganans';

    protected $fillable = [
        'semester_id',
        'nama',
        'deskripsi',
        'harga',
        'durasi_bulan',
        'status',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'durasi_bulan' => 'integer',
    ];

    /**
     * Relasi ke Semester (Semester 1 atau Semester 2).
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    /**
     * Relasi ke data langganan pengguna.
     */
    public function langganans()
    {
        return $this->hasMany(Langganan::class, 'paket_langganan_id');
    }

    /**
     * Scope untuk mengambil paket yang berstatus aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk paket semester tertentu.
     */
    public function scopeForSemester($query, int $semesterId)
    {
        return $query->where('semester_id', $semesterId);
    }

    /**
     * Mengambil paket Semester 1 aktif.
     */
    public static function getPaketSemester1(): ?self
    {
        return static::aktif()
            ->whereHas('semester', fn($q) => $q->where('nama', 'like', '%1%'))
            ->first();
    }

    /**
     * Mengambil paket Semester 2 aktif.
     */
    public static function getPaketSemester2(): ?self
    {
        return static::aktif()
            ->whereHas('semester', fn($q) => $q->where('nama', 'like', '%2%'))
            ->first();
    }
}
