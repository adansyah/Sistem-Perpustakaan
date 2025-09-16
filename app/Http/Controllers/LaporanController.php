<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Exports\PinjamExport;
use App\Exports\LaporanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanBulananExport;
use App\Exports\LaporanTerlambatExport;

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
        $dendaPerHari = 5000; // bisa diganti sesuai aturan
        $loans = Loan::with('anggota', 'Details.book')
            ->where('status', 'dikembalikan')
            ->get()
            ->filter(function ($loan) {
                $batas = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);
                $tanggalKembali = \Carbon\Carbon::parse($loan->tanggal_kembali);

                return $tanggalKembali->greaterThan($batas);
            })
            ->map(function ($loan) use ($dendaPerHari) {
                $batas = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);
                $tanggalKembali = \Carbon\Carbon::parse($loan->tanggal_kembali);

                // hitung telat berapa hari
                $loan->telat_hari = $tanggalKembali->diffInDays($batas);

                // hitung denda
                $loan->denda = $loan->telat_hari * $dendaPerHari;

                return $loan;
            });

        return view('page.laporan.terlambat', compact('loans'));
    }



    public function laporanBulanan()
    {
        $start = now()->startOfMonth();
        $end   = now()->endOfMonth();

        $loans = Loan::with('anggota')
            ->whereBetween('tanggal_pinjam', [$start, $end])
            ->orWhereBetween('tanggal_kembali', [$start, $end])
            ->get()
            ->unique('id');

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

    public function ExcelBuku()
    {
        return Excel::download(new LaporanExport, 'daftar_buku.xlsx');
    }
    public function PdfBuku()
    {
        $buku = Book::select('id', 'induk', 'judul', 'penulis', 'penerbit', 'kategori', 'tahun', 'jumlah_eksemplar')->get();
        $pdf = Pdf::loadView('page.laporan.export.exportbuku', compact('buku'));
        return $pdf->download('daftar_buku.pdf');
    }
    public function ExcelPinjam()
    {
        return Excel::download(new PinjamExport, 'daftar_pinjaman.xlsx');
    }
    public function PdfPinjam()
    {
        $loans = Loan::with('anggota', 'details.book')
            ->where('status', 'dipinjam')
            ->get();
        $pdf = Pdf::loadView('page.laporan.export.exportpinjam', compact('loans'));
        return $pdf->download('daftar_pinjaman.pdf');
    }

    public function ExcelTerlambat()
    {
        return Excel::download(new LaporanTerlambatExport, 'laporan_terlambat.xlsx');
    }

    public function PdfTerlambat()
    {
        $dendaPerHari = 5000;

        $loans = Loan::with('anggota', 'details.book')
            ->where('status', 'dikembalikan')
            ->get()
            ->filter(function ($loan) {
                $batas = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);
                $tanggalKembali = \Carbon\Carbon::parse($loan->tanggal_kembali);

                return $tanggalKembali->greaterThan($batas);
            })
            ->map(function ($loan) use ($dendaPerHari) {
                $batas = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);
                $tanggalKembali = \Carbon\Carbon::parse($loan->tanggal_kembali);

                $loan->telat_hari = $tanggalKembali->diffInDays($batas);
                $loan->denda = $loan->telat_hari * $dendaPerHari;

                return $loan;
            });

        $pdf = Pdf::loadView('page.laporan.export.exportterlambat', compact('loans'));
        return $pdf->download('laporan_terlambat.pdf');
    }

    public function ExcelBulanan()
    {
        return Excel::download(new LaporanBulananExport, 'laporan_bulanan.xlsx');
    }

    public function PdfBulanan()
    {
        $loans = Loan::where(function ($query) {
            $query->whereMonth('tanggal_pinjam', now()->month)
                ->whereYear('tanggal_pinjam', now()->year)
                ->orWhere(function ($query) {
                    $query->whereMonth('tanggal_kembali', now()->month)
                        ->whereYear('tanggal_kembali', now()->year);
                });
        })
            ->with(['anggota', 'details.book'])
            ->get();

        $pdf = Pdf::loadView('page.laporan.export.exportbulanan', compact('loans'));
        return $pdf->download('laporan_bulanan.pdf');
    }
}
