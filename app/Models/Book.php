<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'induk',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'kategori',
        'jumlah_eksemplar',
        'file',
        'rating',
        'tgl_masuk'
    ];

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
}
