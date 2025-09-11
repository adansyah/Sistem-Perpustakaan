<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    protected $fillable = [
        'loan_id',
        'tanggal_pengembalian',
        'denda',
    ];

    // Relasi ke Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
