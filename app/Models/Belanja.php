<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

  public function barangs(): BelongsToMany
  {
    return $this->belongsToMany(Barang::class)
      ->withPivot(['jumlah', 'harga', 'desc', 'user_id'])
      ->withTimestamps();
  }

  public function getTotalBarangAttribute()
  {
    return $this->barangs->reduce(function ($carry, $barang) {
      return $carry + $barang->pivot->jumlah * $barang->pivot->harga;
    }, 0);
  }

}
