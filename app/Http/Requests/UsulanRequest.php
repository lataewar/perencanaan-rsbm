<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class UsulanRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'perencanaan_id' => ['required'],
      'ul_name' => ['required'],
      'ul_qty' => ['required', 'integer'],
      'ul_prise' => ['nullable', 'integer'],
      'ul_desc' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'perencanaan_id' => Session::get('usulan'),
      'ul_prise' => !$this->ul_prise ? null : str_replace(".", "", $this->ul_prise),
      'ul_qty' => str_replace(".", "", $this->ul_qty),
    ]);
  }

  public function messages(): array
  {
    return [
      'ul_name.required' => 'Nama Barang harus diisi.',
      'ul_qty.required' => 'Jumlah Barang harus diisi.',
      'ul_name.integer' => 'Jumlah Barang harus berupa angka.',
      'ul_prise.integer' => 'Harga Barang harus berupa angka.',
    ];
  }
}
