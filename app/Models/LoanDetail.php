<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $fillable = [
        'loan_id',
        'book_id',
        'jumlah'
    ];

    // Relasi ke Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // Relasi ke Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
