<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'anggota_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'denda',
        'status',
    ];

    // Relasi ke Member
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function Details()
    {
        return $this->hasMany(LoanDetail::class);
    }

    public function returnBook()
    {
        return $this->hasOne(ReturnBook::class, 'loan_id');
    }
}
