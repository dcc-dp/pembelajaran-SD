<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $table = 'kurikulums';

    protected $fillable = [
        'nama',
        'deskripsi',
        'status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function repositories()
    {
        return $this->hasMany(Repository::class, 'kurikulum_id');
    }
}