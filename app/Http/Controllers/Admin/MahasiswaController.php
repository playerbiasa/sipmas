<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MahasiswaTemplateExport;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\MahasiswasDataTable;

class MahasiswaController extends Controller
{
    public function index(MahasiswasDataTable $dataTable)
    {
        $prodis = Prodi::all();
        return $dataTable->render('mahasiswa.index', compact('prodis'));
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv|max:10240',
            ]);

            $import = new MahasiswaImport();
            Excel::import($import, $request->file('file'));

            $rowCount = $import->getRowCount();
            if ($rowCount === 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tidak ada data yang diimport. Pastikan sheet pertama berisi data.',
                    'data' => ['imported_rows' => 0]
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diimport',
                'data' => ['imported_rows' => $rowCount]
            ], 200);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $rowNum = $failure->row(); // Nomor baris
                $errors = $failure->errors(); // Array error
                $customErrors = [];
                foreach ($errors as $error) {
                    // Kustomisasi pesan error
                    if (str_contains($error, 'nim has already been taken')) {
                        $value = $failure->values()['nim'] ?? '';
                        $customErrors[] = "NIM '$value' sudah digunakan.";
                    } elseif (str_contains($error, 'email has already been taken')) {
                        $value = $failure->values()['email'] ?? '';
                        $customErrors[] = "Email '$value' sudah terdaftar.";
                    } elseif (str_contains($error, 'prodi_id does not exist')) {
                        $value = $failure->values()['prodi_id'] ?? '';
                        $customErrors[] = "Prodi ID '$value' tidak valid.";
                    } else {
                        $customErrors[] = $error; // Default jika tidak ada kustomisasi
                    }
                }
                $errorMessages[] = "Baris $rowNum: " . implode(', ', $customErrors);
            }
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(' | ', $errorMessages),
                'errors' => $errorMessages
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengimport data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nimMahasiswa' => 'required|unique:mahasiswas,nim',
            'namaMahasiswa' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswas,email',
            'prodi_id' => 'required|exists:prodis,id'
        ]);

        // Simpan data mahasiswa
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nimMahasiswa,
            'nama_mahasiswa' => $request->namaMahasiswa,
            'email' => $request->email,
            'prodi_id' => $request->prodi_id,
            'password' => Hash::make($request->nimMahasiswa)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa berhasil ditambahkan.'
        ]);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi'); // Jika ada relasi dengan tabel `prodi`
        return response()->json($mahasiswa);
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi'); // Jika ada relasi dengan tabel `prodi`
        return response()->json($mahasiswa);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required',
            'prodi' => 'required|exists:prodis,id',
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama,
            'prodi_id' => $request->prodi,
        ]);
        return response()->json(['message' => 'Data mahasiswa berhasil diperbarui.']);
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
        $mahasiswa->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function reset($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Password direset menjadi NIM mahasiswa
        $newPassword = $mahasiswa->nim;
        $mahasiswa->password = Hash::make($newPassword);
        $mahasiswa->save();

        return response()->json([
            'success' => true,
            'message' => "Password berhasil direset."
        ]);
    }

    public function template()
    {
        return Excel::download(new MahasiswaTemplateExport(),'template_import_mahasiswa.xlsx');
    }
}
