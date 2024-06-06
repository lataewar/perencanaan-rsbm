<?php

namespace Database\Seeders;

use App\Models\JenisBelanja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SubJenbelSeeder extends Seeder
{
  public function run(): void
  {

    $count = 5;

    foreach (JenisBelanja::all() as $item_1) {
      JenisBelanja::factory($count)
        ->state(
          new Sequence(
            function (Sequence $sequence) use ($item_1) {
              $kode = fake()->randomNumber(2, true);
              return [
                'jb_kode' => $kode,
                'jb_fullkode' => $item_1->jb_fullkode . '.' . $kode,
                'jenis_belanja_id' => $item_1->id,
                'jb_level' => 2,
              ];
            }
          )
        )
        ->create()
        ->each(function ($item_2) use ($count) {
          JenisBelanja::factory($count)
            ->state(
              new Sequence(
                function (Sequence $sequence) use ($item_2) {
                  $kode = fake()->randomNumber(2, true);
                  return [
                    'jb_kode' => $kode,
                    'jb_fullkode' => $item_2->jb_fullkode . '.' . $kode,
                    'jenis_belanja_id' => $item_2->id,
                    'jb_level' => 3,
                  ];
                }
              )
            )->create();
        });
    }

  }
}
