<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'urutan',
        'status',
    ];

    /**
     * Scope untuk FAQ dengan status aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}