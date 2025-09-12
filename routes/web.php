<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('PostLogin');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('buku', BukuController::class)
        ->parameters(['buku' => 'id'])
        ->names('buku');

    Route::resource('anggota', AnggotaController::class)
        ->parameters(['anggota' => 'id'])
        ->names('anggota');

    Route::resource('loans', LoanController::class);

    Route::prefix('laporan')->group(function () {
        Route::get('/buku', [LaporanController::class, 'laporanBuku'])->name('laporan.buku');
        Route::get('/buku/excel', [LaporanController::class, 'ExcelBuku'])->name('laporan.buku.excel');
        Route::get('/buku/pdf', [LaporanController::class, 'PdfBuku'])->name('laporan.buku.pdf');

        Route::get('/dipinjam', [LaporanController::class, 'laporanDipinjam'])->name('laporan.dipinjam');
        Route::get('/pinjam/excel', [LaporanController::class, 'ExcelPinjam'])->name('laporan.pinjam.excel');
        Route::get('/pinjam/pdf', [LaporanController::class, 'PdfPinjam'])->name('laporan.pinjam.pdf');

        Route::get('/terlambat', [LaporanController::class, 'laporanTerlambat'])->name('laporan.terlambat');
        Route::get('/terlambat/excel', [LaporanController::class, 'ExcelTerlambat'])->name('laporan.terlambat.excel');
        Route::get('/terlambat/pdf', [LaporanController::class, 'PdfTerlambat'])->name('laporan.terlambat.pdf');

        Route::get('/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');
        Route::get('/bulanan/excel', [LaporanController::class, 'ExcelBulanan'])->name('laporan.bulanan.excel');
        Route::get('/bulanan/pdf', [LaporanController::class, 'PdfBulanan'])->name('laporan.bulanan.pdf');
    });

    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan.index');
});
