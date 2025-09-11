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

    // Relasi ke Admin (User)


    // Relasi ke LoanDetails
    public function Details()
    {
        return $this->hasMany(LoanDetail::class);
    }

    // Relasi ke Returns
    public function returnBook()
    {
        return $this->hasOne(ReturnBook::class, 'loan_id');
    }
}
