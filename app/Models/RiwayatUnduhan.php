<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatUnduhan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_unduhan';

    public $timestamps = false; // hanya created_at, tidak ada updated_at

    protected $fillable = [
        'user_id',
        'repository_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class, 'repository_id');
    }
}