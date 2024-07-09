<?php

namespace App\Http\Controllers;

use App\Services\BarangService;
use App\Services\JenbelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SelectorController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq');
  }

  public function getJenbel(Request $request): JsonResponse
  {
    return response()->json(['data' => self::jenbels($request->jenbel_id, $request->jenbel_lvl)]);
  }

  private static function jenbels(string $id, string|int $lvl)
  {
    $jenbels = app(JenbelService::class)->getBySelf($id, $lvl);

    $data = "<option value='' hidden>Pilih salah satu ...</option>";
    foreach ($jenbels as $item) {
      $data .= "<option value='" . $item->id . "'>" . $item->fullkode . " - " . $item->name . "</option>";
    }

    return $data;
  }

  public function getBarang(Request $request): JsonResponse
  {
    return response()->json(['data' => self::barangs($request->jenbel_id)]);
  }

  private static function barangs(string $id)
  {
    $barangs = app(BarangService::class)->getByJenbel($id);

    $data = "<option value='' hidden>Pilih salah satu ...</option>";
    foreach ($barangs as $item) {
      $data .= "<option value='" . $item->id . "'>" . $item->kode . " - " . $item->name . "</option>";
    }

    return $data;
  }
}
