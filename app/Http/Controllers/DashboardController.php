<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Services\PerencanaanService;
use App\Services\UnitService;
use Illuminate\View\View;

class DashboardController extends Controller
{
  public function index(): View
  {
    if (auth()->user()->hasRole('unit'))
      return view('dashboard.unit', [
        'unit' => app(UnitService::class)->dashboard_get_count(),
        'dikirim' => app(PerencanaanService::class)->dashboard_get_count_by_unit_and_status(auth()->user()->unit_id, StatusEnum::DIKIRIM->value),
        'disetujui' => app(PerencanaanService::class)->dashboard_get_count_by_unit_and_status(auth()->user()->unit_id, StatusEnum::DISETUJUI->value),
      ]);

    return view('dashboard.admin', [
      'unit' => app(UnitService::class)->dashboard_get_count(),
      'dikirim' => app(PerencanaanService::class)->dashboard_get_count_by_year_and_status((int) date('Y'), StatusEnum::DIKIRIM->value),
      'disetujui' => app(PerencanaanService::class)->dashboard_get_count_by_year_and_status((int) date('Y'), StatusEnum::DISETUJUI->value),
    ]);
  }
}
