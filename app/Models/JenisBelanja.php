<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisBelanja extends Model
{
  use HasFactory;

  protected $fillable = ['jb_kode', 'jb_name', 'jb_desc', 'jenis_belanja_id', 'jb_fullkode', 'jb_level'];

  public function jenis_belanjas(): HasMany
  {
    return $this->hasMany(JenisBelanja::class);
  }

  public function jenis_belanja(): BelongsTo
  {
    return $this->belongsTo(JenisBelanja::class);
  }
}
