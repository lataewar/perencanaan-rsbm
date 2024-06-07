<?php

namespace App\Http\Requests;

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
        'role_id' => 'required',
      ];
    }

    return [
      'name' => 'required|string|max:255',
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role_id' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'role_id.required' => 'Role is required.',
    ];
  }
}
