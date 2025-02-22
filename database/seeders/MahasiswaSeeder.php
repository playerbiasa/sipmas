<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => '1218170',
            'nama_mahasiswa' => 'Adi Cahyono',
            'prodi_id' => 1,
            'email' => 'email@sipmas.com',
            'password' => Hash::make('123456789'),
            'is_verified'   => 1,
        ]);
    }
}
