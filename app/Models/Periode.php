<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
  use HasFactory, UUID;

  protected $guarded = [];

  public function perencanaans(): HasMany
  {
    return $this->hasMany(Perencanaan::class);
  }
}
