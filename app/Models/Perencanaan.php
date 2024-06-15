<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perencanaan extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['p_tahun', 'p_periode', 'unit_id', 'user_id'];

  public function unit(): BelongsTo
  {
    return $this->belongsTo(Unit::class, 'unit_id', 'id');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function statuses(): HasMany
  {
    return $this->hasMany(Status::class);
  }
}
