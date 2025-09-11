<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{

    protected $table = 'anggotas';
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
