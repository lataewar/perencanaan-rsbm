<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubMenuRequest;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Services\Datatables\SubMenuTableService;
use App\Services\SubMenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubMenuController extends Controller
{
  public function __construct(
    protected SubMenuService $service
  ) {
  }

  public function index(Menu $menu): View
  {
    return view('submenu.index', ['data' => $menu]);
  }

  public function datatable(int $menu, SubMenuTableService $datatable): JsonResponse
  {
    return $datatable->table($menu);
  }

  public function create(Menu $menu): View
  {
    return view('submenu.create', ['data' => $menu]);
  }

  public function store($menu, SubMenuRequest $request): RedirectResponse
  {
    // return $request;
    $query = $this->service->store($request);
    if ($query)
      Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil ditambahkan.', 'success');

    return redirect()->route('submenu.index', ['menu' => $menu]);
  }

  public function edit(Menu $menu, SubMenu $submenu)
  {
    return view('submenu.edit', [
      'data' => $submenu,
      'menu' => $menu
    ]);
  }

  public function update($menu, SubMenu $submenu, SubMenuRequest $request): RedirectResponse
  {
    $query = $this->service->update($submenu, $request);
    if ($query)
      Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil diubah.', 'success');

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
