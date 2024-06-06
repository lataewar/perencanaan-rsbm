<?php

namespace App\Http\Requests;

use App\Services\JenbelService;
use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'br_name' => ['required'],
      'br_kode' => [],
      'br_satuan' => ['required'],
      'br_desc' => [],
      'jenis_belanja_id' => ['required'],
    ];
  }

  protected function prepareForValidation(): void
  {
    if ($this->jenis_belanja_id) {
      $jenbel = app(JenbelService::class)->find($this->jenis_belanja_id)->jb_level == 3 ? true : false;

      $this->merge([
        'jenis_belanja_id' => $jenbel ? $this->jenis_belanja_id : null,
      ]);
    }
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Nama harus diisi.',
      'jenis_belanja_id.required' => 'Inputan baru tidak sinkron dengan jenis belanja.',
    ];
  }
}
