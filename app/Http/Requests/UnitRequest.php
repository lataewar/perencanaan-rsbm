<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'u_name' => ['required'],
      'u_kode' => ['required'],
      'u_desc' => [],
    ];
  }

  public function messages(): array
  {
    return [
      'u_name.required' => 'Nama harus diisi.',
      'u_kode.required' => 'Kode harus diisi.',
    ];
  }
}
