<?php

namespace App\Http\Requests;

use App\Services\JenbelService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class BarangRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'br_name' => ['required'],
      'br_kode' => [],
      'br_satuan' => ['required'],
      'br_desc' => [],
      'jenis_belanja_id' => [Rule::requiredIf($this->method() == "POST")], // berstatus required jika method = POST
    ];
  }

  protected function prepareForValidation(): void
  {
    if ($this->method() == "POST") {
      $jenbel = app(JenbelService::class)->find(Session::get('jenis_belanja_id'));
      $merged = null;

      if ($jenbel) {
        if ($jenbel->jb_level == 3)
          $merged = Session::get('jenis_belanja_id');
      }

      $this->merge([
        'jenis_belanja_id' => $merged,
      ]);
    }
  }

  public function messages(): array
  {
    return [
      'br_name.required' => 'Nama harus diisi.',
      'br_satuan.required' => 'Satuan harus diisi.',
      'jenis_belanja_id.*' => 'Inputan baru tidak sinkron dengan jenis belanja.',
    ];
  }
}
