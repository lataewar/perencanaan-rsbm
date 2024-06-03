<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'guard_name', 'desc'];

  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }

  public function menus(): BelongsToMany
  {
    return $this->belongsToMany(Menu::class);
  }

  public function permissions(): BelongsToMany
  {
    return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
  }
}
