<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\JenisBelanja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
  protected $model = Barang::class;

  public function definition(): array
  {
    $ids = JenisBelanja::where('jb_level', 3)->pluck('id');
    return [
      'br_kode' => fake()->randomNumber(6, true),
      'br_name' => fake()->word(),
      'br_desc' => fake()->words(3, true),
      'br_satuan' => fake()->word(),
      'jenis_belanja_id' => fake()->randomElement($ids),
    ];
  }
}
