<?php
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');   
    Route::get('/jurusan/print', [JurusanController::class, 'print'])
        ->name('jurusan.print'); 
    Route::get('/jurusan/export-excel', [JurusanController::class, 'exportExcel'])
        ->name('jurusan.export-excel');
    Route::get('/jurusan/export-csv', [JurusanController::class, 'exportCsv'])
        ->name('jurusan.export-csv');
    Route::resource('jurusan', JurusanController::class);
    
    Route::get('/mahasiswa/export-csv', [MahasiswaController::class, 'exportCsv'])
        ->name('mahasiswa.export-csv');
    Route::get('/mahasiswa/export-excel', [MahasiswaController::class, 'exportExcel'])
        ->name('mahasiswa.export-excel');
    Route::get('/mahasiswa/print', [MahasiswaController::class, 'print'])
        ->name('mahasiswa.print');
    Route::resource('mahasiswa', MahasiswaController::class);

    
    Route::get('/matakuliah/print', [MatakuliahController::class, 'print'])
        ->name('matakuliah.print'); 
    Route::get('/matakuliah/export-excel', [MatakuliahController::class, 'exportExcel'])
        ->name('matakuliah.export-excel');
    Route::get('/matakuliah/export-csv', [MatakuliahController::class, 'exportCsv'])
        ->name('matakuliah.export-csv');
    Route::resource('matakuliah', MatakuliahController::class);
});

require __DIR__.'/auth.php';
