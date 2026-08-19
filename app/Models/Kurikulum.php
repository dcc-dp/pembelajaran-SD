<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama',
    'deskripsi',
    'status',
];

    public function repositories()
        {
            return $this->hasMany(Repository::class, 'kurikulum_id');
        }

}