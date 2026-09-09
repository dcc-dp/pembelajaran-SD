<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';

    protected $fillable = [
        'nama',
        'urutan',
        'status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function repositories()
    {
        return $this->hasMany(Repository::class, 'semester_id');
    }

    public function paketLangganans()
    {
        return $this->hasMany(PaketLangganan::class, 'semester_id');
    }
}