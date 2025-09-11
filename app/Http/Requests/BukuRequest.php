<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'judul' => 'required',
            'penulis' => 'required|max:255',
            'penerbit' => 'required',
            'tahun' => 'required',
            'kategori' => 'required|in:fiksi,non',
            'jumlah_eksemplar' => 'required|min:0',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'rating' => 'required|in:1,2,3,4,5',
        ];
    }
}
