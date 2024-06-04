<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'name' => ['required'],
      'desc' => [],
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Nama harus diisi.',
    ];
  }
}
