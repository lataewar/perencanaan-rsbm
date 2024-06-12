<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerencanaanRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'p_tahun' => ['required'],
      'p_periode' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'p_periode' => 1,
    ]);
  }

  public function messages(): array
  {
    return [
      'p_tahun.required' => 'Tahun harus dipilih.',
    ];
  }
}
