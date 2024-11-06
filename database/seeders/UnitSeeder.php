<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
  public function run(): void
  {
    Unit::insert([
      [
        "u_name" => "Kelompok Staf Medis",
        "u_kode" => "-",
        "u_desc" => "Kelompok Staf Medis",
        "id" => "9d41d1fe-530c-470b-b815-a85a0e9b9ae0",
        "is_has_ruang" => true,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Pelayanan Medis",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Pelayanan Medis",
        "id" => "9d41d3ba-68fb-4013-8899-ad5aeb0b7fd4",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Rawat Inap",
        "u_kode" => "-",
        "u_desc" => "Instalasi Rawat Inap",
        "id" => "9d41d3ba-69f3-4ce5-b26e-0eb0bcb935ca",
        "is_has_ruang" => true,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Rawat Jalan",
        "u_kode" => "-",
        "u_desc" => "Instalasi Rawat Jalan",
        "id" => "9d41d3ba-69fa-4d49-b306-ffd0a0621117",
        "is_has_ruang" => true,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Kamar Bersalin",
        "u_kode" => "-",
        "u_desc" => "Instalasi Kamar Bersalin",
        "id" => "9d41d3ba-69fd-415d-8b7d-891fdf270685",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Bedah Sentral",
        "u_kode" => "-",
        "u_desc" => "Instalasi Bedah Sentral",
        "id" => "9d41d3ba-69ff-49d1-bd09-d08037bda712",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "ICCU",
        "u_kode" => "-",
        "u_desc" => "ICCU",
        "id" => "9d41d3ba-6a04-4578-bac4-068900a71409",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "ICU",
        "u_kode" => "-",
        "u_desc" => "ICU",
        "id" => "9d41d3ba-6a06-4615-9d10-67d436fe774a",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "NICU",
        "u_kode" => "-",
        "u_desc" => "NICU",
        "id" => "9d41d3ba-6a0a-49fa-b269-7c0d8c16faad",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "PICU",
        "u_kode" => "-",
        "u_desc" => "PICU",
        "id" => "9d41d3ba-6a0c-464a-96bd-adf529aad930",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Pelayanan Keperawatan",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Pelayanan Keperawatan",
        "id" => "9d41d3ba-6a0d-4d62-a6f4-ff846c4fea41",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Radiologi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Radiologi",
        "id" => "9d41d48d-2a81-4887-be1d-6c563519fc33",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Gizi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Gizi",
        "id" => "9d41d48d-2aff-4782-988a-35c9b59dfff7",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Patologi Klinik",
        "u_kode" => "-",
        "u_desc" => "Instalasi Patologi Klinik",
        "id" => "9d41d48d-2b02-4ce0-b7c6-69799853f438",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Rehabilitasi Medik",
        "u_kode" => "-",
        "u_desc" => "Instalasi Rehabilitasi Medik",
        "id" => "9d41d48d-2b05-47d3-95b6-6f3b445bb829",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi CSSD dan Binatu",
        "u_kode" => "-",
        "u_desc" => "Instalasi CSSD dan Binatu",
        "id" => "9d41d48d-2b08-4491-85a3-6ae5c33ef425",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Forensik, Medikolegal dan Pemulsaran Jenazah",
        "u_kode" => "-",
        "u_desc" => "Instalasi Forensik, Medikolegal dan Pemulsaran Jenazah",
        "id" => "9d41d48d-2b11-4920-8a6d-58efd30c46fd",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Gas Medik",
        "u_kode" => "-",
        "u_desc" => "Instalasi Gas Medik",
        "id" => "9d41d48d-2b14-419a-af63-27660177476d",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Farmasi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Farmasi",
        "id" => "9d41d48d-2b16-4e59-a4f9-bfd868a9e005",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Patologi Anatomi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Patologi Anatomi",
        "id" => "9d41d48d-2b18-4c64-ba96-33df9e052614",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Penunjang Pelayanan",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Penunjang Pelayanan",
        "id" => "9d41d48d-2b1a-41a5-ad70-814bcf041d6b",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Pemeliharaan Sarana dan Prasarana",
        "u_kode" => "-",
        "u_desc" => "Instalasi Pemeliharaan Sarana dan Prasarana",
        "id" => "9d41d55c-683e-417b-ae17-c70c079724bd",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Sanitasi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Sanitasi",
        "id" => "9d41d55c-68bc-481d-b8e5-9ee6166649f8",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Umum",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Umum",
        "id" => "9d41d55c-68bf-42b7-b6c9-c89aa3160d4c",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Sumber Daya Manusia",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Sumber Daya Manusia",
        "id" => "9d41d55c-68c2-47c8-a39f-c2ff02c54ec6",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Keuangan",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Keuangan",
        "id" => "9d41d55c-68c4-430c-ac26-5ae84d250b98",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Perencanaan dan Evaluasi",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Perencanaan dan Evaluasi",
        "id" => "9d41d55c-68c6-458d-9907-fe44487b85a7",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi SIMRS",
        "u_kode" => "-",
        "u_desc" => "Instalasi SIMRS",
        "id" => "9d41d55c-68c8-4500-adcc-cd29c7c12d3e",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Informasi dan Rekam Medis",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Informasi dan Rekam Medis",
        "id" => "9d41d55c-68ca-458f-a333-b1c20dd9a835",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Diklat dan Litbang",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Diklat dan Litbang",
        "id" => "9d41d55c-68cc-4d48-b394-286959911c95",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
    ]);

    $b_pelayanan_medis = Bidang::find('9d41d1fe-527c-4dce-9b92-99403f9de481');
    $b_pelayanan_medis->units()->attach([
      '9d41d1fe-530c-470b-b815-a85a0e9b9ae0',
      '9d41d3ba-68fb-4013-8899-ad5aeb0b7fd4',
    ]);

    $b_pelayanan_keperawatan = Bidang::find('9d41d1fe-52fa-4aa9-ae64-d6fa16a883f3');
    $b_pelayanan_keperawatan->units()->attach([
      '9d41d3ba-69f3-4ce5-b26e-0eb0bcb935ca',
      '9d41d3ba-69fa-4d49-b306-ffd0a0621117',
      '9d41d3ba-69fd-415d-8b7d-891fdf270685',
      '9d41d3ba-69ff-49d1-bd09-d08037bda712',
      '9d41d3ba-6a04-4578-bac4-068900a71409',
      '9d41d3ba-6a06-4615-9d10-67d436fe774a',
      '9d41d3ba-6a0a-49fa-b269-7c0d8c16faad',
      '9d41d3ba-6a0c-464a-96bd-adf529aad930',
      '9d41d3ba-6a0d-4d62-a6f4-ff846c4fea41',
    ]);

    $b_penunjang_pelayanan = Bidang::find('9d41d1fe-52fd-457b-923d-d52dfc13f693');
    $b_penunjang_pelayanan->units()->attach([
      '9d41d48d-2a81-4887-be1d-6c563519fc33',
      '9d41d48d-2aff-4782-988a-35c9b59dfff7',
      '9d41d48d-2b02-4ce0-b7c6-69799853f438',
      '9d41d48d-2b05-47d3-95b6-6f3b445bb829',
      '9d41d48d-2b08-4491-85a3-6ae5c33ef425',
      '9d41d48d-2b11-4920-8a6d-58efd30c46fd',
      '9d41d48d-2b14-419a-af63-27660177476d',
      '9d41d48d-2b16-4e59-a4f9-bfd868a9e005',
      '9d41d48d-2b18-4c64-ba96-33df9e052614',
      '9d41d48d-2b1a-41a5-ad70-814bcf041d6b',
    ]);

    $b_umum = Bidang::find('9d41d1fe-5300-41f1-9fa7-3ea44faf4798');
    $b_umum->units()->attach([
      '9d41d55c-683e-417b-ae17-c70c079724bd',
      '9d41d55c-68bc-481d-b8e5-9ee6166649f8',
      '9d41d55c-68bf-42b7-b6c9-c89aa3160d4c',
    ]);

    $b_sdm = Bidang::find('9d41d1fe-5302-4e60-a9d5-88b76bcbb8dd');
    $b_sdm->units()->attach([
      '9d41d55c-68c2-47c8-a39f-c2ff02c54ec6',
    ]);

    $b_keuangan = Bidang::find('9d41d1fe-5304-459f-90e0-6e61970480b6');
    $b_keuangan->units()->attach([
      '9d41d55c-68c4-430c-ac26-5ae84d250b98',
    ]);

    $b_perencanaan = Bidang::find('9d41d1fe-5306-4ec1-9cc7-c759d36975f3');
    $b_perencanaan->units()->attach([
      '9d41d55c-68c6-458d-9907-fe44487b85a7',
    ]);

    $b_informasi_rekammedis = Bidang::find('9d41d1fe-5308-4c24-94a1-c50a1f5b4eee');
    $b_informasi_rekammedis->units()->attach([
      '9d41d55c-68c8-4500-adcc-cd29c7c12d3e',
      '9d41d55c-68ca-458f-a333-b1c20dd9a835',
    ]);

    $b_diklat_litbang = Bidang::find('9d41d1fe-5309-43b8-8148-471306eb9781');
    $b_diklat_litbang->units()->attach([
      '9d41d55c-68cc-4d48-b394-286959911c95',
    ]);


  }
}
