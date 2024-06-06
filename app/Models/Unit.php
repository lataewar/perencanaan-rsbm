<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
  use HasFactory;

  protected $fillable = ['u_name', 'u_kode', 'u_desc'];

  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }
}
