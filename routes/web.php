<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MahasiswaController;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::post('/mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
Route::get('/mahasiswa/search', [MahasiswaController::class, 'search'])->name('mahasiswa.search');
Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
Route::get('/template',[MahasiswaController::class, 'template'])->name('mahasiswa.template');
