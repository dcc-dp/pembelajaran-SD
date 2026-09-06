<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'nama',
    'nama_sekolah',
    'email',
    'no_hp',
    'foto',
    'password'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get avatar photo URL with fallback.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->foto)) {
            return \Illuminate\Support\Facades\Storage::url($this->foto);
        }

        return asset('assets/admin/img/user.jpg');
    }

    /**
     * Compatibility accessor for templates using ->name instead of ->nama.
     */
    public function getNameAttribute(): ?string
    {
        return $this->nama;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function langganans()
        {
            return $this->hasMany(Langganan::class, 'user_id');
        }

    public function riwayatUnduhan()
        {
            return $this->hasMany(RiwayatUnduhan::class, 'user_id');
        }

    public function logAktivitas()
        {
            return $this->hasMany(LogAktivitas::class, 'user_id');
        }
}
