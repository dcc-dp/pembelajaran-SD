<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'urutan',
        'status',
    ];

    public function repositories()
    {
        return $this->hasMany(Repository::class, 'kelas_id');
    }

    public function paketLangganans()
    {
        return $this->hasMany(PaketLangganan::class, 'kelas_id');
    }
}