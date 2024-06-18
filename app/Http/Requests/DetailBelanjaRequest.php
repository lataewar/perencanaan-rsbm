<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DetailBelanjaRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'barang_id' => [Rule::requiredIf($this->method() == "POST")],
      'jumlah' => ['required', 'integer'],
      'harga' => ['required', 'integer'],
      'desc' => [],
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
      'barang_id.*' => 'Barang harus diisi.',
      'jumlah.required' => 'Jumlah harus diisi.',
      'jumlah.integer' => 'Jumlah harus berupa angka yang valid.',
      'harga.required' => 'Harga harus diisi.',
      'harga.integer' => 'Harga harus berupa angka yang valid.',
    ];
  }
}
