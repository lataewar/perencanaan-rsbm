<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['u_name', 'u_kode', 'u_desc'];

  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }

  public function bidangs(): BelongsToMany
  {
    return $this->belongsToMany(Bidang::class);
  }
}
