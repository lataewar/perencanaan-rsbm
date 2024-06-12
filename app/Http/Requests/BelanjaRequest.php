<?php

namespace App\Http\Requests;

use App\Services\JenbelService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class BelanjaRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'jenis_belanja_id' => ['required'],
      'perencanaan_id' => ['required'],
      'b_desc' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    $jenbel = app(JenbelService::class)->find($this->jenis_belanja_id);
    $merged = $this->jenis_belanja_id;

    if ($jenbel) {
      if ($jenbel->jb_level != 3)
        $merged = null;
    }

    $this->merge([
      'jenis_belanja_id' => $merged,
      'perencanaan_id' => Session::get('rbelanja'),
    ]);
  }

  public function messages(): array
  {
    return [
      'jenis_belanja_id.*' => 'Inputan baru tidak sinkron dengan jenis belanja.',
    ];
  }
}
