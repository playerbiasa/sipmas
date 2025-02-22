<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodis';
    protected $fillable = [
        'nama_prodi',
        'singkatan',
        'jenjang',
        'akreditasi',
        'nosk_akreditasi',
        'tahun_akreditasi'
    ];

    protected $casts = [
        'jenjang' => 'string',
    ];
}
