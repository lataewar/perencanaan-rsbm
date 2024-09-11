<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usulan extends Model
{
  use HasFactory, UUID;

  protected $guarded = [];

  public function perencanaan(): BelongsTo
  {
    return $this->belongsTo(Perencanaan::class);
  }

  public function ruangan(): BelongsTo
  {
    return $this->belongsTo(Ruangan::class);
  }
}
