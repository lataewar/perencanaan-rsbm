<?php

namespace App\Http\Requests;

use App\Services\PerencanaanService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
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
      'is_exist' => [],
      'message' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    if ($this->method() == "POST") {
      $datas = app(PerencanaanService::class)->validate_isexist($this->barang_id, Session::get('belanja_id'));
      $msg = '';
      if ($datas->count()) {
        $msg = 'Sudah pernah diadakan sebelumnya, pada tahun';
        foreach ($datas as $data) {
          $msg .= ' ' . $data->p_tahun;
        }
        $this->merge([
          'is_exist' => 1,
          'message' => $msg,
        ]);
      } else {
        $this->merge([
          'is_exist' => 0,
          'message' => null,
        ]);
      }
    }

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
