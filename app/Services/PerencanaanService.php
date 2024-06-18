<?php

namespace App\Services;

use App\Http\Requests\PerencanaanRequest;
use App\Models\Perencanaan;
use App\Repositories\PerencanaanRepository;
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

  public function store(PerencanaanRequest $request): Perencanaan
  {
    return $this->repository->store((object) $request->validated());
  }

  public function find_total(string $id): ?Perencanaan
  {
    return $this->repository->find_total($id);
  }

  public function update_status(string $id, int $status, string $msg): bool
  {
    return $this->repository->update_status($id, $status, $msg);
  }

  public function getTahun(): array
  {
    $arrays = array();
    for ($i = 0; $i < 10; $i++) {
      array_push($arrays, [
        'id' => 2024 + $i,
        'name' => 2024 + $i,
      ]);
    }
    return $arrays;
  }
}
