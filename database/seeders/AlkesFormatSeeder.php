<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AlkesFormatSeeder extends Seeder
{
  public function run(): void
  {
    $sql_file_1 = File::get(base_path("database/data/alkes_formats_1.sql"));
    $sql_file_2 = File::get(base_path("database/data/alkes_formats_2.sql"));
    $sql_file_3 = File::get(base_path("database/data/alkes_formats_3.sql"));
    DB::unprepared($sql_file_1);
    DB::unprepared($sql_file_2);
    DB::unprepared($sql_file_3);
  }
}
