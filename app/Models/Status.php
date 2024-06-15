<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['perencanaan_id', 'user_id', 'status', 'message'];

  protected function casts(): array
  {
    return [
      'status' => StatusEnum::class,
    ];
  }

  public function perencanaan(): BelongsTo
  {
    return $this->belongTo(Perencanaan::class);
  }
}
