<?php

namespace App\Models;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $fillable = ['nim', 'nama_mahasiswa', 'prodi_id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
