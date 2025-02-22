<?php

namespace App\Models;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Mahasiswa extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;

    protected $table = 'mahasiswas';
    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'prodi_id',
        'email',
        'password',
        'otp',
        'is_verified',
        'otp_expired_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'otp_expired_at' => 'datetime',
        ];
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
}
