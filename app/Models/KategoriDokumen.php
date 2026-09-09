<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'urutan',
        'status',
    ];

    public function jenisDokumens()
    {
        return $this->hasMany(JenisDokumen::class, 'kategori_dokumen_id');
    }
}