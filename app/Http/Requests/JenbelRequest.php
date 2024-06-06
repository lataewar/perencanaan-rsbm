<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenbelRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'jb_name' => ['required'],
      'jb_kode' => ['sometimes', 'required'],
      'jb_desc' => [],
      'jb_level' => ['numeric', 'between:1,3'],
      'parent_fullkode' => [],
      'jenis_belanja_id' => [],
    ];
  }

  public function messages(): array
  {
    return [
      'jb_name.required' => 'Jenis Belanja harus diisi.',
      'jb_kode.required' => 'Kode Rekening harus diisi.',
    ];
  }
}
