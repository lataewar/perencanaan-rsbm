<?php

namespace App\Http\Controllers;

use App\Services\Datatables\AlkesTableService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AlkesFormatController extends Controller
{
  public function __construct(
    protected AlkesTableService $service
  ) {
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('alkes.index');
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return $this->service->table();
  }
}
