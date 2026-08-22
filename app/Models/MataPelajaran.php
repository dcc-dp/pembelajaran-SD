<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'urutan',
        'status',
    ];

    public function repositories()
    {
        return $this->hasMany(Repository::class, 'mata_pelajaran_id');
    }
}