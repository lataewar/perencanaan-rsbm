<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perencanaan extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['p_tahun', 'p_periode', 'p_status', 'unit_id', 'user_id'];

  protected function casts(): array
  {
    return [
      'p_status' => StatusEnum::class,
    ];
  }

  public function unit(): BelongsTo
  {
    return $this->belongsTo(Unit::class, 'unit_id', 'id');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}