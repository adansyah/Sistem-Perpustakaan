<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PinjamExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return  Loan::with('anggota', 'details.book')
            ->where('status', 'dipinjam')
            ->get();
    }

    public function headings(): array
    {
        return ["No", "Anggota", "Buku", "jumlah", "Tanggal Pinjam", "Tanggal Kembali"];
    }

    public function map($loan): array
    {
        return [
            $loan->id, // No (atau bisa pakai nomor urut manual)
            $loan->anggota->nama ?? '-',
            $loan->details->pluck('book.judul')->implode(', '), // gabung semua judul buku
            $loan->details->sum('jumlah'),
            $loan->tanggal_pinjam
                ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->translatedFormat('d F Y')
                : '-',
            $loan->tanggal_kembali
                ? \Carbon\Carbon::parse($loan->tanggal_kembali)->translatedFormat('d F Y')
                : '-',
        ];
    }
}
