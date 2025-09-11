<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporanBuku()
    {
        $buku = Book::all();
        return view('page.laporan.buku', compact('buku'));
    }

    public function laporanDipinjam()
    {
        $loans = Loan::with('anggota', 'details.book')
            ->where('status', 'dipinjam')
            ->get();
        return view('page.laporan.dipinjam', compact('loans'));
    }

    public function laporanTerlambat()
    {
        $today = now();
        $loans = Loan::with('anggota', 'Details.book')
            ->where('status', 'dikembalikan')
            ->whereDate('tanggal_pinjam', '<', $today->subDays(7))
            ->get();
        return view('page.laporan.terlambat', compact('loans'));
    }

    public function laporanBulanan()
    {
        $loans = Loan::where(function ($query) {
            $query->whereMonth('tanggal_pinjam', now()->month)
                ->whereYear('tanggal_pinjam', now()->year)
                ->orWhere(function ($query) {
                    $query->whereMonth('tanggal_kembali', now()->month)
                        ->whereYear('tanggal_kembali', now()->year);
                });
        })
            ->with('anggota')
            ->get();

        return view('page.laporan.bulanan', compact('loans'));
    }


    public function laporan()
    {
        $daftarBuku = Book::all();

        $sedangDipinjam = Loan::where('status', 'dipinjam')->with('anggota')->get();

        $terlambat = Loan::where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->with('anggota')
            ->get();

        $bulanan = Loan::whereMonth('tanggal_pinjam', now()->month)
            ->whereYear('tanggal_pinjam', now()->year)
            ->with('anggota')
            ->get();

        return view('page.laporan.index', compact('daftarBuku', 'sedangDipinjam', 'terlambat', 'bulanan'));
    }
}
