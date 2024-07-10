<?php

namespace App\Http\Requests;

use App\Services\PerencanaanService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class BelanjaRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'perencanaan_id' => ['required'],
      'jenbel_1' => ['required'],
      'jenbel_2' => ['required'],
      'jenis_belanja_id' => ['required'],
      'barang_id' => ['required'],
      'jumlah' => ['required', 'integer'],
      'harga' => ['required', 'integer'],
      'desc' => [],
      'is_exist' => [],
      'message' => [],
      'sumber_anggaran' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    $datas = app(PerencanaanService::class)->validate_isexist($this->barang_id, Session::get('perencanaan_id'));
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

    $this->merge([
      'jumlah' => str_replace(".", "", $this->jumlah),
      'harga' => str_replace(".", "", $this->harga),
      'perencanaan_id' => Session::get('perencanaan_id'),
    ]);
  }

  public function messages(): array
  {
    return [
      'barang_id.*' => 'Barang harus diisi.',
      'jenbel_1.*' => 'Jenis Belanja harus diisi.',
      'jenbel_2.*' => 'Jenis Belanja harus diisi.',
      'jenis_belanja_id.*' => 'Jenis Belanja harus diisi.',
      'jumlah.required' => 'Jumlah harus diisi.',
      'jumlah.integer' => 'Jumlah harus berupa angka yang valid.',
      'harga.required' => 'Harga harus diisi.',
      'harga.integer' => 'Harga harus berupa angka yang valid.',
    ];
  }
}
