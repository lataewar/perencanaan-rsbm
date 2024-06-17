<?php

use App\Enums\StatusEnum;
use App\Models\Belanja;
use App\Models\Perencanaan;
use App\Models\Status;
use App\Models\Unit;
use App\Models\User;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {

  // $var = [];
  // for ($i = 0; $i < 20; $i++) {
  //   array_push($var, fake()->unique()->numberBetween($min = 1000, $max = 9000));
  // }
  // return $var;

  /*
  $units_arr = [
    "Seksi Pelayanan Fasilitas Medis",
    "Seksi Pengendalian Mutu & Pelayanan Medis",
    "Seksi Asuhan Keperawatan",
    "Seksi Manajemen Keperawatan",
    "Seksi Pelayanan Fasilitas Penunjang Medis",
    "Seksi Pengendalian Mutu dan Medis",
    "Subag Administrasi & Ketatausahaan",
    "Subag Perlengkapan & Rumah Tangga",
    "Gudang",
    "Subag Humas & Hukum",
    "Subag Administrasi Kepegawaian & Penempatan",
    "Subag Pengembangan SDM",
    "Subag Mutasi & Akreditasi",
    "Seksi Diklat",
    "Seksi Litbang & Perpustakaan",
    "Seksi Penyusunan Program & Anggaran",
    "Seksi Evaluasi & Penyusunan Laporan",
    "Subag Akuntansi & Verifikasi",
    "Subag Perbendaharaan",
    "Kasir Rawat Inap/Rawat Jalan/IGD",
    "Subag Mobilisasi Dana",
    "Seksi Rekam Medis",
    "SO Pendaftaran Rawat Jalan",
    "SO Pendaftaran IGD & Rawat Inap",
    "Seksi Sistem Informasi & Pemasaran",
    "Unit Rumah Susun",
    "Instalasi Gawat Darurat",
    "Ruang OK IGD",
    "IGD Unit 118",
    "IKOS",
    "Ruang Anastesi",
    "Instalasi Radiologi",
    "Instalasi Farmasi",
    "Instalasi Laboratorium",
    "Instalasi Gizi",
    "Unit Binatu",
    "Unit CSSD",
    "Instalasi Sanitasi",
    "Instalasi Forensik, Medikolegal dan Pemulasaran Jenazah",
    "IPSRS",
    "Instalasi Gas Medik",
    "Instalasi Patologi Anatomi",
    "Instalasi Rehabilitasi Medik",
    "Instalasi SIMRS",
    "Poli Penyakit Dalam",
    "Poli Geriatri",
    "Poli Kulit & Kelamin",
    "Poli Anak",
    "Poli Jantung",
    "Poli Orthopedi & Traumatologi/Bedah Saraf/Forensik",
    "Poli Bedah Onkologi/Bedah Umum/Bedah Vaskuler",
    "Poli Gigi & Mulut",
    "Poli Mata",
    "Poli Kandungan",
    "Poli Saraf",
    "Poli Umum dan MCU",
    "Poli THT",
    "Poli Teratai",
    "Poli Jiwa",
    "Poli Paru dan TB",
    "Poli Urologi dan Digestif",
    "Poliklinik Bedah Plastik Rekonstruksi dan Estetik/Bedah Anak",
    "Poli Gizi",
    "Unit Hemodialisa",
    "Unit Cath Lab",
    "Ruang Lambu Barakati Lt.I (Kls.I)",
    "Ruang Laika Morini VIP A (Super VIP)",
    "Ruang Laika Mendidoha Lt.I (Kls.I)",
    "Ruang Tumbu Dadi",
    "Ruang NICU",
    "Ruang ICU (Banua Poago)",
    "Ruang ICCU",
    "Ruang Lambu Barakati Lt.II (Anak)",
    "Ruang Raha Mongkilo (Kls.II)",
    "Ruang Laika Mendidoha VIP",
    "Ruang Laika Waraka Lt.I (Bedah)",
    "Ruang Laika Waraka Lt.II (Non Bedah)",
    "Ruang PICU (Raha Sangia Lombo-lombo)",
    "Ruang Isolasi (Sapo Mononaa)",
    "Ruang Perinatologi",
    "Ruang Kemoterapi (Te Tampa I'doa)",
    "Ruang Endoscopy",
    "Unit Bank Darah (UTDRS)",
  ];

  $colls = collect();
  foreach ($units_arr as $item) {
    $unit = Unit::create([
      'u_name' => $item,
      'u_kode' => '-',
      'u_desc' => $item,
    ]);
    $colls->push($unit);
  }

  return $colls;
  */

  return User::where('role_id', 5)->get();


});
