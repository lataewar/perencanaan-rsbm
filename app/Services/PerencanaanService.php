<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Requests\UsulanRequest;
use App\Models\Perencanaan;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

class PerencanaanService extends BaseService
{
  public function __construct(
    protected PerencanaanRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function table(): LengthAwarePaginator
  {
    return $this->repository->table();
  }

  public function setfilter(Request $request): void
  {
    if ($request->action == 'reset') {
      Session::forget('ptable');
    } else if ($request->action == 'submit') {
      Session::put('ptable.units', $request->units);
      Session::put('ptable.status', $request->status);
    } else {
      Session::put('ptable.per_page', $request->per_page);
    }
  }

  public function store(UsulanRequest $request): Perencanaan
  {
    return $this->repository->store((object) $request->validated());
  }

  public function find_total(string $id): ?Perencanaan
  {
    return $this->repository->find_total($id);
  }

  public function find_status(string $id): ?Perencanaan
  {
    return $this->repository->find_status($id);
  }

  public function reject(string $id): bool
  {
    app(BelanjaRepository::class)->delete_belanja($id);

    return $this->update_status($id, StatusEnum::DITOLAK->value, 'Perencanaan ditolak.');
  }

  public function update_status(string $id, int $status, string $msg): bool
  {
    return $this->repository->update_status($id, $status, $msg);
  }

  public function validate_isexist(string $barang_id, string $perencanaan_id): Collection
  {
    return $this->repository->validate_isexist($barang_id, $perencanaan_id);
  }

  public function dashboard_get_count_by_year_and_status(int $year, int $status): int
  {
    return $this->repository->get_count_by_year_and_status($year, $status);
  }

  public function dashboard_get_count_by_unit_and_status(string $unit, int $status): int
  {
    return $this->repository->get_count_by_unit_and_status($unit, $status);
  }

  public function usul_table(): LengthAwarePaginator
  {
    return $this->repository->usul_table();
  }

  public function find_usulan(string $id): ?Perencanaan
  {
    return $this->repository->find_usulan($id);
  }

  public function find_usulan_with_status(string $id): ?Perencanaan
  {
    return $this->repository->find_usulan_with_status($id);
  }
}
