<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_dokumen_id',
        'nama',
        'deskripsi',
        'urutan',
        'status',
    ];

    public function kategoriDokumen()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_dokumen_id');
    }

    public function repositories()
    {
        return $this->hasMany(Repository::class, 'jenis_dokumen_id');
    }
}