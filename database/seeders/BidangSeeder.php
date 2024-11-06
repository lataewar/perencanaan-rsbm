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
        "id" => "9d41d1fe-527c-4dce-9b92-99403f9de481",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Pelayanan Keperawatan",
        "b_kode" => "-",
        "b_desc" => "Pelayanan Keperawatan",
        "id" => "9d41d1fe-52fa-4aa9-ae64-d6fa16a883f3",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Penunjang Pelayanan",
        "b_kode" => "-",
        "b_desc" => "Penunjang Pelayanan",
        "id" => "9d41d1fe-52fd-457b-923d-d52dfc13f693",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Umum",
        "b_kode" => "-",
        "b_desc" => "Umum",
        "id" => "9d41d1fe-5300-41f1-9fa7-3ea44faf4798",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Sumber Daya Manusia",
        "b_kode" => "-",
        "b_desc" => "Sumber Daya Manusia",
        "id" => "9d41d1fe-5302-4e60-a9d5-88b76bcbb8dd",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Keuangan",
        "b_kode" => "-",
        "b_desc" => "Keuangan",
        "id" => "9d41d1fe-5304-459f-90e0-6e61970480b6",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Perencanaan dan Evaluasi",
        "b_kode" => "-",
        "b_desc" => "Perencanaan dan Evaluasi",
        "id" => "9d41d1fe-5306-4ec1-9cc7-c759d36975f3",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Informasi dan Rekam Medis",
        "b_kode" => "-",
        "b_desc" => "Informasi dan Rekam Medis",
        "id" => "9d41d1fe-5308-4c24-94a1-c50a1f5b4eee",
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "b_name" => "Diklat dan Litbang",
        "b_kode" => "-",
        "b_desc" => "Diklat dan Litbang",
        "id" => "9d41d1fe-5309-43b8-8148-471306eb9781",
        "updated_at" => now(),
        "created_at" => now()
      ],
    ]);
  }
}
