<?php

namespace App\Services\Datatables;

use App\Models\Belanja;
use App\Repositories\BelanjaRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class DetailBelanjaTableService extends DatatableService
{
  public function __construct(
    protected BelanjaRepository $repository
  ) {
  }

  public function table(string $id): JsonResponse
  {
    return DataTables::of($this->repository->table_barangs($id))
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('perencanaan update') && auth()->user()->can('update', Belanja::class) ?
          self::editBtnA(route('detailbelanja.edit', ['barang' => $data->barang_id, 'belanja' => $data->belanja_id])) : '';
        $strMenu .= auth()->user()->can('perencanaan delete') && auth()->user()->can('update', Belanja::class) ?
          self::deleteBtn($data->barang_id . '-x-' . $data->belanja_id, $data->br_name) : '';

        return $strMenu;
      })
      ->addColumn('harga', function ($data) {
        return formatNomor($data->harga);
      })
      ->addColumn('jumlah', function ($data) {
        return formatNomor($data->jumlah) . ' ' . $data->br_satuan;
      })
      ->addColumn('total', function ($data) {
        return formatNomor($data->harga * $data->jumlah);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb', 'harga', 'jumlah', 'total'])
      ->make();
  }
}
