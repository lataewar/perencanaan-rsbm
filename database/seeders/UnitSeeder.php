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
        "id" => "f35cfb7d-52fe-4c52-90c4-2bc907987b09",
        "is_has_ruang" => true,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Pelayanan Medis",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Pelayanan Medis",
        "id" => "d7dd2920-37c2-4d5d-8d6b-d974f047806b",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Rawat Inap",
        "u_kode" => "-",
        "u_desc" => "Instalasi Rawat Inap",
        "id" => "2fd31e71-9334-46e5-aae2-4a21ffefdf52",
        "is_has_ruang" => true,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Rawat Jalan",
        "u_kode" => "-",
        "u_desc" => "Instalasi Rawat Jalan",
        "id" => "b433c233-b91f-4b41-ab33-b39f9433174e",
        "is_has_ruang" => true,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Kamar Bersalin",
        "u_kode" => "-",
        "u_desc" => "Instalasi Kamar Bersalin",
        "id" => "71d97120-0b57-485c-a827-36d51a73d03a",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Bedah Sentral",
        "u_kode" => "-",
        "u_desc" => "Instalasi Bedah Sentral",
        "id" => "4524d4c8-f794-4ac4-a714-41b09cec3ace",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "ICCU",
        "u_kode" => "-",
        "u_desc" => "ICCU",
        "id" => "c3e7722b-ac2a-475a-aaff-e60ec390cebb",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "ICU",
        "u_kode" => "-",
        "u_desc" => "ICU",
        "id" => "4360a591-c744-45d8-9618-16aa42a3382b",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "NICU",
        "u_kode" => "-",
        "u_desc" => "NICU",
        "id" => "b1c40f06-e7a7-4550-bfff-c5876319a6f7",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "PICU",
        "u_kode" => "-",
        "u_desc" => "PICU",
        "id" => "97926780-f074-44be-ad8c-dde6abc79695",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Pelayanan Keperawatan",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Pelayanan Keperawatan",
        "id" => "78b574ad-bad8-47fa-81b2-bab72e355d48",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Radiologi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Radiologi",
        "id" => "68addb8c-86cc-462a-8f7b-a15eb24bf2fe",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Gizi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Gizi",
        "id" => "95c5b442-e3fc-4821-9e6c-04d9f08cf2b8",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Patologi Klinik",
        "u_kode" => "-",
        "u_desc" => "Instalasi Patologi Klinik",
        "id" => "411fb01e-a56b-47ff-82dd-f847a8adbdd0",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Rehabilitasi Medik",
        "u_kode" => "-",
        "u_desc" => "Instalasi Rehabilitasi Medik",
        "id" => "0b5e95f6-30d0-430d-b2de-e5826de6d96e",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi CSSD dan Binatu",
        "u_kode" => "-",
        "u_desc" => "Instalasi CSSD dan Binatu",
        "id" => "de59808c-7ac5-4b80-8477-e7509f2db1f1",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Forensik, Medikolegal dan Pemulsaran Jenazah",
        "u_kode" => "-",
        "u_desc" => "Instalasi Forensik, Medikolegal dan Pemulsaran Jenazah",
        "id" => "61c7a731-1c33-4fd7-88b2-e12506b9a075",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Gas Medik",
        "u_kode" => "-",
        "u_desc" => "Instalasi Gas Medik",
        "id" => "99b7c26f-9676-4a74-aa48-805fa9fefcd5",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Farmasi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Farmasi",
        "id" => "5a06b3e0-3036-45fd-b39b-15ace9a505fd",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Patologi Anatomi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Patologi Anatomi",
        "id" => "43b5901a-7d9a-4b93-b75b-9e3372918571",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Penunjang Pelayanan",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Penunjang Pelayanan",
        "id" => "bf96b6c1-2725-455a-b908-ab82bee9236f",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Pemeliharaan Sarana dan Prasarana",
        "u_kode" => "-",
        "u_desc" => "Instalasi Pemeliharaan Sarana dan Prasarana",
        "id" => "97ab02b3-b062-40c6-9e87-a84077d7d5ab",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi Sanitasi",
        "u_kode" => "-",
        "u_desc" => "Instalasi Sanitasi",
        "id" => "aedfc9ef-5fce-4754-8360-24f2bbf30af0",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Umum",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Umum",
        "id" => "9e86e663-7008-42f0-9955-d168380874cd",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Sumber Daya Manusia",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Sumber Daya Manusia",
        "id" => "85d14bf2-2f99-47fc-ae11-d8a95cc1ada6",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Keuangan",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Keuangan",
        "id" => "5cf4b10a-5064-4973-8efb-54ea2f57388f",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Perencanaan dan Evaluasi",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Perencanaan dan Evaluasi",
        "id" => "89ee45c5-1245-419a-a2a0-cbda76ea6745",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Instalasi SIMRS",
        "u_kode" => "-",
        "u_desc" => "Instalasi SIMRS",
        "id" => "d130f8a9-dbc0-439e-9989-869411006a76",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Informasi dan Rekam Medis",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Informasi dan Rekam Medis",
        "id" => "9517cf6a-6d3b-465c-9437-8d89a8ce39bf",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
      [
        "u_name" => "Sub Bidang Diklat dan Litbang",
        "u_kode" => "-",
        "u_desc" => "Sub Bidang Diklat dan Litbang",
        "id" => "c20fca05-487f-4ba0-a272-7e8e0231fa29",
        "is_has_ruang" => false,
        "updated_at" => now(),
        "created_at" => now()
      ],
    ]);

    $b_pelayanan_medis = Bidang::find('13d70039-3e0a-4f49-a9fa-a7e330b7b41d');
    $b_pelayanan_medis->units()->attach([
      'f35cfb7d-52fe-4c52-90c4-2bc907987b09',
      'd7dd2920-37c2-4d5d-8d6b-d974f047806b',
    ]);

    $b_pelayanan_keperawatan = Bidang::find('247f626c-e321-4ce5-944a-1248b4809e0b');
    $b_pelayanan_keperawatan->units()->attach([
      '2fd31e71-9334-46e5-aae2-4a21ffefdf52',
      'b433c233-b91f-4b41-ab33-b39f9433174e',
      '71d97120-0b57-485c-a827-36d51a73d03a',
      '4524d4c8-f794-4ac4-a714-41b09cec3ace',
      'c3e7722b-ac2a-475a-aaff-e60ec390cebb',
      '4360a591-c744-45d8-9618-16aa42a3382b',
      'b1c40f06-e7a7-4550-bfff-c5876319a6f7',
      '97926780-f074-44be-ad8c-dde6abc79695',
      '78b574ad-bad8-47fa-81b2-bab72e355d48',
    ]);

    $b_penunjang_pelayanan = Bidang::find('9a874145-e333-4ef4-953c-8d01cc81537f');
    $b_penunjang_pelayanan->units()->attach([
      '68addb8c-86cc-462a-8f7b-a15eb24bf2fe',
      '95c5b442-e3fc-4821-9e6c-04d9f08cf2b8',
      '411fb01e-a56b-47ff-82dd-f847a8adbdd0',
      '0b5e95f6-30d0-430d-b2de-e5826de6d96e',
      'de59808c-7ac5-4b80-8477-e7509f2db1f1',
      '61c7a731-1c33-4fd7-88b2-e12506b9a075',
      '99b7c26f-9676-4a74-aa48-805fa9fefcd5',
      '5a06b3e0-3036-45fd-b39b-15ace9a505fd',
      '43b5901a-7d9a-4b93-b75b-9e3372918571',
      'bf96b6c1-2725-455a-b908-ab82bee9236f',
    ]);

    $b_umum = Bidang::find('98455b5b-3542-459f-adc7-0edd80dfe82e');
    $b_umum->units()->attach([
      '97ab02b3-b062-40c6-9e87-a84077d7d5ab',
      'aedfc9ef-5fce-4754-8360-24f2bbf30af0',
      '9e86e663-7008-42f0-9955-d168380874cd',
    ]);

    $b_sdm = Bidang::find('7ae1d3dc-73e9-4c36-add6-5b6c951d9ac9');
    $b_sdm->units()->attach([
      '85d14bf2-2f99-47fc-ae11-d8a95cc1ada6',
    ]);

    $b_keuangan = Bidang::find('cd277789-85df-4924-90c9-e86da09ebaad');
    $b_keuangan->units()->attach([
      '5cf4b10a-5064-4973-8efb-54ea2f57388f',
    ]);

    $b_perencanaan = Bidang::find('208ca3ff-2f49-437d-ad6f-40a59be94bff');
    $b_perencanaan->units()->attach([
      '89ee45c5-1245-419a-a2a0-cbda76ea6745',
    ]);

    $b_informasi_rekammedis = Bidang::find('df7577b0-1d02-40d0-9731-001610b0b36b');
    $b_informasi_rekammedis->units()->attach([
      'd130f8a9-dbc0-439e-9989-869411006a76',
      '9517cf6a-6d3b-465c-9437-8d89a8ce39bf',
    ]);

    $b_diklat_litbang = Bidang::find('e336fee6-57d2-4c26-b8a6-12a0e6c9c1ec');
    $b_diklat_litbang->units()->attach([
      'c20fca05-487f-4ba0-a272-7e8e0231fa29',
    ]);


  }
}
