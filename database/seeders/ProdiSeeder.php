<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create([
            'nama_prodi' => 'Akuntansi',
            'singkatan' => '',
            'jenjang' => 'S1',
            'akreditasi' => '',
            'nosk_akreditasi' => 'S1',
            'tahun_akreditasi' => 'S1',
        ]);

        Prodi::create([
            'nama_prodi' => 'Ekonomi Islam',
            'singkatan' => '',
            'jenjang' => 'S1',
            'akreditasi' => '',
            'nosk_akreditasi' => 'S1',
            'tahun_akreditasi' => 'S1',
        ]);

        Prodi::create([
            'nama_prodi' => 'Manajemen',
            'singkatan' => '',
            'jenjang' => 'S1',
            'akreditasi' => '',
            'nosk_akreditasi' => 'S1',
            'tahun_akreditasi' => 'S1',
        ]);
    }
}
