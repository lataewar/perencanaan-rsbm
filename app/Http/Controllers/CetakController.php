<?php

namespace App\Http\Controllers;

use App\Services\PhpSpreadsheet\CetakPerencanaanService;
use App\Services\PhpSpreadsheet\CetakUsulanService;

class CetakController extends Controller
{
  public function __construct(
    protected CetakPerencanaanService $cetakPerencanaanService,
    protected CetakUsulanService $cetakUsulanService,
  ) {
  }

  public function cetak_perencanaan(string $id): void
  {
    $this->cetakPerencanaanService->cetak($id);
  }

  public function cetak_usulan(string $id): void
  {
    $this->cetakUsulanService->cetak($id);
  }

}
