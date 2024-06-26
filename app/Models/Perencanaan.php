<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perencanaan extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['p_tahun', 'p_periode', 'unit_id', 'user_id'];

  protected static function booted(): void
  {
    static::deleting(function (Model $model) {
      // IF USER ROLE IS UNIT
      if (auth()->check() && auth()->user()->role_id->isUnit()) {
        abort_if($model->unit_id != auth()->user()->unit_id, 401);
      }
    });
  }

  public function scopeUnit_scope(Builder $builder): void
  {
    // IF USER ROLE IS UNIT
    if (auth()->check() && auth()->user()->role_id->isUnit())
      $builder->where('u.id', auth()->user()->unit_id);
  }

  public function scopeNon_unit_scope(Builder $builder): void
  {
    // IF USER ROLE IS NOT UNIT
    if (auth()->check() && !auth()->user()->role_id->isUnit())
      $builder->where('statuses.status', '!=', StatusEnum::DRAFT->value);
  }

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
