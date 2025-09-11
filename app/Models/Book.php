<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'kategori',
        'jumlah_eksemplar',
        'file',
    ];

    // Relasi ke LoanDetails
    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
}
