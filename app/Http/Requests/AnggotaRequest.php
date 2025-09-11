<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggotaRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'nama' => 'required',
            'alamat' => 'required|max:255',
            'no_telp' => 'required',
        ];
    }
}
