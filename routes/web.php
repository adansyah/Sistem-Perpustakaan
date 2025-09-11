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
        Route::get('/dipinjam', [LaporanController::class, 'laporanDipinjam'])->name('laporan.dipinjam');
        Route::get('/terlambat', [LaporanController::class, 'laporanTerlambat'])->name('laporan.terlambat');
        Route::get('/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');
    });

    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan.index');
});
