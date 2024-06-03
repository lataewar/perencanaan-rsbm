<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubMenuRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'name' => ['required'],
      'route' => [],
      'icon' => [],
      'desc' => [],
      'menu_id' => ['required'],
    ];
  }

  protected function prepareForValidation(): void
  {
    // icon not yet implemented on submenu
    $this->merge([
      'icon' => '',
    ]);
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Nama harus diisi.',
    ];
  }
}
