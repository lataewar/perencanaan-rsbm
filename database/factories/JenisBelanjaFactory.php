<?php

namespace Database\Factories;

use App\Models\JenisBelanja;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisBelanja>
 */
class JenisBelanjaFactory extends Factory
{
  protected $model = JenisBelanja::class;

  public function definition(): array
  {
    $kode = fake()->randomNumber(2, true);
    return [
      'jb_kode' => $kode,
      'jb_name' => fake()->word(),
      'jb_desc' => fake()->words(3, true),
      'jb_level' => 1,
      'jb_fullkode' => $kode,
    ];
  }
}
