<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubMenuRequest;
use App\Services\Datatables\SubMenuTableService;
use App\Services\MenuService;
use App\Services\SubMenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubMenuController extends Controller
{
  public function __construct(
    protected SubMenuService $service
  ) {
    $this->middleware('permission:menu create')->only(['create', 'store']);
    $this->middleware('permission:menu read')->only(['index', 'datatable']);
    $this->middleware('permission:menu update')->only(['edit', 'update']);
    $this->middleware('permission:menu delete')->only(['destroy']);
  }

  public function index($menu): View
  {
    return view('submenu.index', [
      'data' => app(MenuService::class)->find($menu)
    ]);
  }

  public function datatable(int $menu, SubMenuTableService $datatable): JsonResponse
  {
    return $datatable->table($menu);
  }

  public function create($menu): View
  {
    return view('submenu.create', [
      'data' => app(MenuService::class)->find($menu)
    ]);
  }

  public function store($menu, SubMenuRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('submenu.index', ['menu' => $menu])->with('success', '<b>' . $query->name . '</b> berhasil ditambahkan.');

    return redirect()->route('submenu.index', ['menu' => $menu]);
  }

  public function edit($menu, $submenu): View
  {
    return view('submenu.edit', [
      'data' => $this->service->find($submenu),
      'menu' => app(MenuService::class)->find($menu),
    ]);
  }

  public function update($menu, $submenu, SubMenuRequest $request): RedirectResponse
  {
    $query = $this->service->update($submenu, $request);
    if ($query)
      return redirect()->route('submenu.index', ['menu' => $menu])->with('success', '<b>' . $query->name . '</b> berhasil diubah.');

    return redirect()->route('submenu.index', ['menu' => $menu]);
  }

  public function destroy($menu, $submenu): JsonResponse
  {
    try {
      $this->service->delete($submenu);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
