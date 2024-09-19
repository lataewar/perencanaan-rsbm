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
        "b_name" => "Pelayanan Medis",
        "b_kode" => "-",
        "b_desc" => "Pelayanan Medis",
        "id" => "13d70039-3e0a-4f49-a9fa-a7e330b7b41d",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Pelayanan Keperawatan",
        "b_kode" => "-",
        "b_desc" => "Pelayanan Keperawatan",
        "id" => "247f626c-e321-4ce5-944a-1248b4809e0b",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Penunjang Pelayanan",
        "b_kode" => "-",
        "b_desc" => "Penunjang Pelayanan",
        "id" => "9a874145-e333-4ef4-953c-8d01cc81537f",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Umum",
        "b_kode" => "-",
        "b_desc" => "Umum",
        "id" => "98455b5b-3542-459f-adc7-0edd80dfe82e",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Sumber Daya Manusia",
        "b_kode" => "-",
        "b_desc" => "Sumber Daya Manusia",
        "id" => "7ae1d3dc-73e9-4c36-add6-5b6c951d9ac9",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Keuangan",
        "b_kode" => "-",
        "b_desc" => "Keuangan",
        "id" => "cd277789-85df-4924-90c9-e86da09ebaad",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Perencanaan dan Evaluasi",
        "b_kode" => "-",
        "b_desc" => "Perencanaan dan Evaluasi",
        "id" => "208ca3ff-2f49-437d-ad6f-40a59be94bff",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Informasi dan Rekam Medis",
        "b_kode" => "-",
        "b_desc" => "Informasi dan Rekam Medis",
        "id" => "df7577b0-1d02-40d0-9731-001610b0b36b",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Diklat dan Litbang",
        "b_kode" => "-",
        "b_desc" => "Diklat dan Litbang",
        "id" => "e336fee6-57d2-4c26-b8a6-12a0e6c9c1ec",
        "updated_at" => now(),
        "created_at" => now()
      ],
    ]);
  }
}
