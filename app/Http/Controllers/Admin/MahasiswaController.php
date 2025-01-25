<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use App\Http\Controllers\Controller;
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
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));
        return response()->json(['success' => true, 'message' => 'Data berhasil diimport']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama' => 'required',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan');
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
        $mahasiswa->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
