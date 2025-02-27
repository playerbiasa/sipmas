<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaSheetImport implements ToModel, WithHeadingRow, WithValidation
{
    public function __construct(MahasiswaImport $parentImport)
    {
        $this->parentImport = $parentImport;
    }

    public function model(array $row): ?Mahasiswa
    {
        if (empty($row) || !array_key_exists('nim', $row) || !array_key_exists('nama_mahasiswa', $row) || !array_key_exists('prodi_id', $row)) {
            return null;
        }

        if (!$row['nim'] || !$row['nama_mahasiswa'] || !$row['prodi_id']) {
            return null;
        }

        $this->parentImport->incrementRowCount();
        return new Mahasiswa([
            'nim' => $row['nim'],
            'nama_mahasiswa' => $row['nama_mahasiswa'],
            'email' => $row['email'],
            'prodi_id' => $row['prodi_id'],
            'password' => Hash::make($row['nim']),
        ]);
    }

    public function rules(): array
    {
        return [
            'nim' => 'required|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required|max:35|string',
            'email' => 'required|unique:mahasiswas,email',
            'prodi_id' => 'required|exists:prodis,id',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM :value sudah terdaftar di database.',
            'nama_mahasiswa.required' => 'Nama Mahasiswa wajib diisi.',
            'nama_mahasiswa.max' => 'Nama Mahasiswa maksimum 35 karakter.',
            'nama_mahasiswa.string' => 'Nama Mahasiswa harus berupa teks.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email :value sudah terdaftar di database.',
            'prodi_id.required' => 'Prodi ID wajib diisi.',
            'prodi_id.exists' => 'Prodi ID :value tidak valid, periksa daftar prodi.',
        ];
    }
}
