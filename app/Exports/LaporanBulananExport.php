<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanBulananExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Loan::where(function ($query) {
            $query->whereMonth('tanggal_pinjam', now()->month)
                ->whereYear('tanggal_pinjam', now()->year)
                ->orWhere(function ($query) {
                    $query->whereMonth('tanggal_kembali', now()->month)
                        ->whereYear('tanggal_kembali', now()->year);
                });
        })
            ->with(['anggota', 'details.book'])
            ->get();
    }

    public function headings(): array
    {
        return ["No", "Nama Anggota", "Buku", "Tanggal Pinjam", "Tanggal Kembali", "Status"];
    }

    public function map($loan): array
    {
        return [
            $loan->id,
            $loan->anggota->nama ?? '-',
            $loan->details->pluck('book.judul')->implode(', '),
            $loan->tanggal_pinjam ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d-m-Y') : '-',
            $loan->tanggal_kembali ? \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d-m-Y') : '-',
            ucfirst($loan->status),
        ];
    }
}
