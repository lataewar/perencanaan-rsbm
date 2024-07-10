<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class JenbelSeeder extends Seeder
{
  public function run(): void
  {

    $sql_file_1 = File::get(base_path("database/data/jenis_belanjas_1.sql"));
    DB::unprepared($sql_file_1);
    $sql_file_2 = File::get(base_path("database/data/jenis_belanjas_2.sql"));
    DB::unprepared($sql_file_2);
    $sql_file_3 = File::get(base_path("database/data/jenis_belanjas_3.sql"));
    DB::unprepared($sql_file_3);
    $sql_file_4 = File::get(base_path("database/data/jenis_belanjas_4.sql"));
    DB::unprepared($sql_file_4);

  }
}
