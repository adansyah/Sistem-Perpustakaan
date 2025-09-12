<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanTerlambatExport implements FromCollection, WithHeadings, WithMapping
{
    protected $dendaPerHari = 5000;

    public function collection()
    {
        return Loan::with('anggota', 'details.book')
            ->where('status', 'dikembalikan')
            ->get()
            ->filter(function ($loan) {
                $batas = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);
                $tanggalKembali = \Carbon\Carbon::parse($loan->tanggal_kembali);

                return $tanggalKembali->greaterThan($batas);
            })
            ->map(function ($loan) {
                $batas = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);
                $tanggalKembali = \Carbon\Carbon::parse($loan->tanggal_kembali);

                $loan->telat_hari = $tanggalKembali->diffInDays($batas);
                $loan->denda = $loan->telat_hari * $this->dendaPerHari;

                return $loan;
            });
    }

    public function headings(): array
    {
        return ["No", "Nama Anggota", "Buku", "Tanggal Pinjam", "Tanggal Kembali", "Telat (hari)", "Denda"];
    }

    public function map($loan): array
    {
        return [
            $loan->id,
            $loan->anggota->nama ?? '-',
            $loan->details->pluck('book.judul')->implode(', '),
            $loan->tanggal_pinjam ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d-m-Y') : '-',
            $loan->tanggal_kembali ? \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d-m-Y') : '-',
            $loan->telat_hari,
            'Rp. ' . number_format($loan->denda, 0, ',', '.'),
        ];
    }
}
