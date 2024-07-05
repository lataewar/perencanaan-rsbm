<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class JenbelSeeder extends Seeder
{
  public function run(): void
  {

    $sql_file = File::get(base_path("database/data/jenis_belanjas.sql"));
    DB::unprepared($sql_file);

  }
}
