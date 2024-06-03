<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'name' => ['required'],
      'route' => [],
      'icon' => [],
      'desc' => [],
      'has_submenu' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'has_submenu' => $this->has_submenu ? true : false,
    ]);
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Nama harus diisi.',
    ];
  }
}
