<?php

namespace App\Http\Controllers;

use App\Services\PhpSpreadsheet\CetakBelanjaService;

class CetakController extends Controller
{
  public function __construct(
    protected CetakBelanjaService $service
  ) {
  }

  public function cetak_belanja(string $id)//: void
  {
    return $this->service->cetak($id);
  }

}
