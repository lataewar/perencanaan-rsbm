<?php

namespace App\Http\Requests;

use App\Services\PeriodeService;
use Illuminate\Foundation\Http\FormRequest;

class UsulanRequest extends FormRequest
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
    $periode = app(PeriodeService::class)->checkIfActive($this->p_tahun);

    if ($periode) {
      $this->merge([
        'p_tahun' => $periode->w_tahun,
        'p_periode' => $periode->w_periode,
      ]);
    } else {
      $this->merge([
        'p_tahun' => null,
        'p_periode' => null,
      ]);
    }

  }

  public function messages(): array
  {
    return [
      'p_tahun.required' => 'Tahun harus dipilih.',
    ];
  }
}
