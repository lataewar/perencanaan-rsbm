<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Belanja extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['perencanaan_id', 'jenis_belanja_id', 'b_desc', 'user_id'];

  public function perencanaan(): BelongsTo
  {
    return $this->belongsTo(Perencanaan::class);
  }

  public function jenis_belanja(): BelongsTo
  {
    return $this->belongsTo(JenisBelanja::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
