<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'name' => ['required'],
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Nama harus diisi.',
    ];
  }
}
