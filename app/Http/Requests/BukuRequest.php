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
            'kategori' => 'required',
            'jumlah_eksemplar' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
