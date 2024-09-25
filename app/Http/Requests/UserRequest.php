<?php

namespace App\Http\Requests;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
  public function rules()
  {
    // if edit without changing password
    if (isset(request()->r_type) && !request()->password) {
      return [
        'name' => 'required|string|max:255',
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
        'role_id' => ['required'],
        'unit_id' => [Rule::requiredIf(UserRoleEnum::UNIT->value == $this->role_id)],
        'bidang_id' => [Rule::requiredIf(UserRoleEnum::BIDANG->value == $this->role_id)],
      ];
    }

    return [
      'name' => 'required|string|max:255',
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role_id' => ['required'],
      'unit_id' => [Rule::requiredIf(UserRoleEnum::UNIT->value == $this->role_id)],
      'bidang_id' => [Rule::requiredIf(UserRoleEnum::BIDANG->value == $this->role_id)],
    ];
  }

  protected function prepareForValidation(): void
  {
    $unit = $this->unit_id;
    $bidang = $this->bidang_id;
    if ($this->role_id != UserRoleEnum::UNIT->value)
      $unit = null;
    if ($this->role_id != UserRoleEnum::BIDANG->value)
      $bidang = null;

    $this->merge([
      'unit_id' => $unit,
      'bidang_id' => $bidang,
    ]);
  }

}
