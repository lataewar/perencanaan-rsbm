<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
  use HasFactory;

  protected $fillable = ['br_name', 'br_kode', 'br_desc', 'br_satuan', 'jenis_belanja_id'];

  public function jenis_belanja(): BelongsTo
  {
    return $this->belongsTo(JenisBelanja::class);
  }
}
