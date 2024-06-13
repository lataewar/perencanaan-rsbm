<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailBelanjaRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'barang_id' => ['required'],
      'jumlah' => ['required', 'numeric'],
      'harga' => ['required', 'numeric'],
      'desc' => [],
    ];
  }

  protected function prepareForValidation(): void
  {

  }

  public function messages(): array
  {
    return [
      'barang_id.required' => 'Barang harus diisi.',
      'jumlah.required' => 'Jumlah harus diisi.',
      'jumlah.numeric' => 'Jumlah harus berupa angka.',
      'harga.required' => 'Harga harus diisi.',
      'harga.numeric' => 'Harga harus berupa angka.',
    ];
  }
}
