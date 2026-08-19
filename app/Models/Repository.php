<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;

    protected $table = 'repositories';

    protected $fillable = [
        'kurikulum_id',
        'semester_id',
        'kelas_id',
        'mata_pelajaran_id',
        'jenis_dokumen_id',
        'judul',
        'deskripsi',
        'nama_file',
        'file',
        'tipe_file',
        'akses',
        'status',
    ];

    public const AKSES_GRATIS = 'gratis';
    public const AKSES_PREMIUM = 'premium';

    public const STATUS_DRAFT = 'draft';
    public const STATUS_DIPUBLIKASIKAN = 'dipublikasikan';
    public const STATUS_DIARSIPKAN = 'diarsipkan';

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_dokumen_id');
    }

    public function riwayatUnduhan()
    {
        return $this->hasMany(RiwayatUnduhan::class, 'repository_id');
    }

    public function scopeGratis($query)
    {
        return $query->where('akses', self::AKSES_GRATIS);
    }

    public function scopePremium($query)
    {
        return $query->where('akses', self::AKSES_PREMIUM);
    }

    public function scopeDipublikasikan($query)
    {
        return $query->where('status', self::STATUS_DIPUBLIKASIKAN);
    }
}