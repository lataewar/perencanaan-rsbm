<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeriodeRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'w_tahun' => ['required'],
      'w_periode' => [
        'required',
        Rule::unique('periodes', 'w_periode')->where('w_tahun', $this->input('w_tahun'))->ignore($this->id),
      ],

      'start' => ['required', 'required_with:end', 'date_format:Y-m-d', 'before_or_equal:end'],
      'end' => ['required', 'required_with:start', 'date_format:Y-m-d', 'after_or_equal:start'],
    ];
  }

  public function messages(): array
  {
    return [
      'w_tahun.required' => 'Isian tahun harus diisi.',
      'w_periode.required' => 'Isian periode harus dipilih.',
      'w_periode.unique' => 'Kombinasi tahun dan periode sudah ada.',

      'start.required' => 'Isian tanggal pengusulan harus diisi.',
      'end.required' => 'Isian tanggal pengusulan harus diisi.',
      'start.required_with' => 'Isian tanggal pengusulan harus diisi.',
      'end.required_with' => 'Isian tanggal pengusulan harus diisi.',
      'start.before_or_equal' => 'Isian -dari- harus berupa tanggal sebelum isian -hingga-',
      'end.after_or_equal' => 'Isian -hingga- harus berupa tanggal setelah isian -dari-',
      'start.date_format' => 'Format isian tanggal pengusulan kurang tepat.',
      'end.date_format' => 'Format isian tanggal pengusulan kurang tepat.',
    ];
  }
}
