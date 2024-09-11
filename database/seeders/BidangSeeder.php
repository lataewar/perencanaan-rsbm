<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BidangSeeder extends Seeder
{

  public function run(): void
  {
    Bidang::insert([
      [
        "b_name" => "Bidang 1",
        "b_kode" => "-",
        "b_desc" => "Bidang Satu",
        "id" => Str::uuid(),
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Bidang 2",
        "b_kode" => "-",
        "b_desc" => "Bidang Dua",
        "id" => Str::uuid(),
        "updated_at" => now(),
        "created_at" => now()
      ],
    ]);
  }
}
