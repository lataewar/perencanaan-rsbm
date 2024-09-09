<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidangRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'b_name' => ['required'],
      'b_kode' => ['required'],
      'b_desc' => [],
    ];
  }

  public function messages(): array
  {
    return [
      'b_name.required' => 'Nama harus diisi.',
      'b_kode.required' => 'Kode harus diisi.',
    ];
  }
}
