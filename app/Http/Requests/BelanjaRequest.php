<?php

namespace App\Http\Requests;

use App\Services\JenbelService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class BelanjaRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'jenis_belanja_id' => [Rule::requiredIf($this->method() == "POST")],
      'perencanaan_id' => [Rule::requiredIf($this->method() == "POST")],
      'b_sumber_anggaran' => [],
      'b_desc' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    if ($this->jenis_belanja_id) {
      $jenbel = app(JenbelService::class)->find($this->jenis_belanja_id);
      $merged = $this->jenis_belanja_id;

      if ($jenbel) {
        if ($jenbel->jb_level != 3)
          $merged = null;
      }

      $this->merge([
        'jenis_belanja_id' => $merged,
        'perencanaan_id' => Session::get('perencanaan_id'),
      ]);
    }
  }

  public function messages(): array
  {
    return [
      'jenis_belanja_id.*' => 'Jenis belanja harus dipilih.',
    ];
  }
}
