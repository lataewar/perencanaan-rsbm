<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perencanaan extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['p_tahun', 'p_periode', 'p_status', 'unit_id', 'user_id'];

  public function unit(): BelongsTo
  {
    return $this->belongTo(Unit::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongTo(User::class);
  }
}
