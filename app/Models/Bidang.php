<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bidang extends Model
{
  use HasFactory, UUID;

  protected $guarded = [];

  public function units(): BelongsToMany
  {
    return $this->belongsToMany(Unit::class);
  }
}
