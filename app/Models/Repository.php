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
        'foto_sampul',
        'nama_file',
        'file',
        'tipe_file',
        'akses',
        'status',
    ];

    public function getSampulUrlAttribute(): ?string
    {
        if ($this->foto_sampul && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->foto_sampul)) {
            return \Illuminate\Support\Facades\Storage::url($this->foto_sampul);
        }
        return null;
    }

    public function getThematicThemeAttribute(): array
    {
        $mapel = strtolower($this->mataPelajaran?->nama ?? '');

        if (str_contains($mapel, 'matematika')) {
            return [
                'gradient' => 'linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%)',
                'accent' => '#93c5fd',
                'icon' => 'ti ti-calculator',
                'pattern' => 'math',
            ];
        } elseif (str_contains($mapel, 'ipa') || str_contains($mapel, 'ipas') || str_contains($mapel, 'alam')) {
            return [
                'gradient' => 'linear-gradient(135deg, #065f46 0%, #059669 100%)',
                'accent' => '#86efac',
                'icon' => 'ti ti-leaf',
                'pattern' => 'science',
            ];
        } elseif (str_contains($mapel, 'indonesia')) {
            return [
                'gradient' => 'linear-gradient(135deg, #9a3412 0%, #ea580c 100%)',
                'accent' => '#fed7aa',
                'icon' => 'ti ti-book-2',
                'pattern' => 'language',
            ];
        } elseif (str_contains($mapel, 'inggris')) {
            return [
                'gradient' => 'linear-gradient(135deg, #3730a3 0%, #6366f1 100%)',
                'accent' => '#c7d2fe',
                'icon' => 'ti ti-language',
                'pattern' => 'english',
            ];
        } elseif (str_contains($mapel, 'pancasila') || str_contains($mapel, 'pkn') || str_contains($mapel, 'kewarganegaraan')) {
            return [
                'gradient' => 'linear-gradient(135deg, #991b1b 0%, #dc2626 100%)',
                'accent' => '#fecaca',
                'icon' => 'ti ti-shield-check',
                'pattern' => 'civics',
            ];
        } elseif (str_contains($mapel, 'agama') || str_contains($mapel, 'islam') || str_contains($mapel, 'pai')) {
            return [
                'gradient' => 'linear-gradient(135deg, #047857 0%, #10b981 100%)',
                'accent' => '#a7f3d0',
                'icon' => 'ti ti-moon-stars',
                'pattern' => 'religion',
            ];
        } elseif (str_contains($mapel, 'seni') || str_contains($mapel, 'budaya') || str_contains($mapel, 'prakarya')) {
            return [
                'gradient' => 'linear-gradient(135deg, #701a75 0%, #c026d3 100%)',
                'accent' => '#f5d0fe',
                'icon' => 'ti ti-palette',
                'pattern' => 'art',
            ];
        } elseif (str_contains($mapel, 'pjok') || str_contains($mapel, 'jasmani') || str_contains($mapel, 'olahraga')) {
            return [
                'gradient' => 'linear-gradient(135deg, #0e7490 0%, #0891b2 100%)',
                'accent' => '#a5f3fc',
                'icon' => 'ti ti-ball-football',
                'pattern' => 'sport',
            ];
        }

        return [
            'gradient' => 'linear-gradient(135deg, #881337 0%, #e11d48 100%)',
            'accent' => '#fecdd3',
            'icon' => 'ti ti-books',
            'pattern' => 'default',
        ];
    }

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