<?php

namespace App\Models;

use App\Enums\SumberAnggaranEnum;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Belanja extends Model
{
  use HasFactory, UUID;

  protected $fillable = ['perencanaan_id', 'jenis_belanja_id', 'b_desc', 'b_sumber_anggaran', 'user_id'];

  protected function casts(): array
  {
    return [
      'b_sumber_anggaran' => SumberAnggaranEnum::class,
    ];
  }

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
      ->withPivot(['id', 'jumlah', 'harga', 'desc', 'is_exist', 'message', 'user_id', 'sumber_anggaran', 'usulan_id', 'skala_prioritas', 'ruangan_id'])
      ->withTimestamps();
  }

  public function getTotalJumlahAttribute()
  {
    return $this->barangs->reduce(function ($carry, $barang) {
      return $carry + $barang->pivot->jumlah;
    }, 0);
  }

  public function getTotalHargaAttribute()
  {
    return $this->barangs->reduce(function ($carry, $barang) {
      return $carry + $barang->pivot->jumlah * $barang->pivot->harga;
    }, 0);
  }

}
