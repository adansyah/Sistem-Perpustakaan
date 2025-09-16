<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings

{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::select('id', 'induk', 'judul', 'penulis', 'penerbit', 'kategori', 'tahun', 'jumlah_eksemplar')->get();
    }

    public function headings(): array
    {
        return ["ID", "No Induk", "Judul", "Penulis", "Penerbit", "Kategori", "Tahun", "Jumlah Buku"];
    }
}
