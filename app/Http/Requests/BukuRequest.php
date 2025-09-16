<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'induk' => 'required|digits:6',
            'judul' => 'required',
            'penulis' => 'required|max:255',
            'penerbit' => 'required',
            'tahun' => 'required',
            'tgl_masuk' => 'required',
            'kategori' => 'required|in:dongeng,cerpen,novel,komik,lainnya',
            'jumlah_eksemplar' => 'required|min:0',
        ];
    }
}
