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

  protected function casts(): array
  {
    return [
      'is_has_ruang' => 'boolean',
    ];
  }

  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }

  public function bidangs(): BelongsToMany
  {
    return $this->belongsToMany(Bidang::class);
  }

  public function isPartOfBidang(string|int $bidang_id): bool
  {
    return $this->bidangs()->where('bidang_id', $bidang_id)->exists();
  }

  public function ruangans(): HasMany
  {
    return $this->hasMany(Ruangan::class);
  }
}
