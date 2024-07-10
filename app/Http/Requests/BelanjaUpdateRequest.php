<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BelanjaUpdateRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'jumlah' => ['required', 'integer'],
      'harga' => ['required', 'integer'],
      'desc' => [],
      'sumber_anggaran' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'jumlah' => str_replace(".", "", $this->jumlah),
      'harga' => str_replace(".", "", $this->harga),
    ]);
  }

  public function messages(): array
  {
    return [
      'jumlah.required' => 'Jumlah harus diisi.',
      'jumlah.integer' => 'Jumlah harus berupa angka yang valid.',
      'harga.required' => 'Harga harus diisi.',
      'harga.integer' => 'Harga harus berupa angka yang valid.',
    ];
  }
}
