<?php

namespace App\Services;

use App\Http\Requests\UsulRequest;
use App\Models\Usulan;
use App\Repositories\UsulanRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsulanService extends BaseService
{
  public function __construct(
    protected UsulanRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function table(string $id): Collection
  {
    return $this->repository->table($id)->get();
  }

  public function setfilter(Request $request): void
  {
    if ($request->action == 'reset') {
      Session::forget('utable');
    } else if ($request->action == 'submit') {
      Session::put('utable.status', $request->status);
    } else {
      Session::put('utable.per_page', $request->per_page);
    }
  }

  public function getTahun(): Collection
  {
    return app(PeriodeService::class)->getAllActive();
  }

  public function store(UsulRequest $request): Usulan
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(string $usul, UsulRequest $request): Usulan
  {
    $validated = (object) $request->validated();
    return $this->repository->update($usul, $validated);
  }
}
