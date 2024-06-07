<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasRoles, UUID;

  protected $fillable = [
    'name',
    'role_id',
    'email',
    'password',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'role_id' => UserRoleEnum::class,
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function isAdmin(): Attribute
  {
    return Attribute::make(
      get: fn() => $this->role_id->isSuperAdmin() || $this->role_id->isAdmin(),
    );
  }

  public function unit(): BelongsTo
  {
    return $this->belongsTo(Unit::class);
  }
}
