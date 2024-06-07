<?php

namespace App\Services;

use App\Http\Requests\JenbelRequest;
use App\Models\JenisBelanja;
use App\Repositories\JenbelRepository;
use Illuminate\Database\Eloquent\Collection;

class JenbelService extends BaseService
{
  public function __construct(
    protected JenbelRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function store(JenbelRequest $request, int|string $parent): JenisBelanja
  {
    $jenis_belanja_id = $parent == 0 ? null : $parent;

    $jb_fullkode = $request->parent_fullkode == 0 ?
      $request->jb_kode :
      $request->parent_fullkode . "." . $request->jb_kode;

    return $this->repository->store((object) ($request->validated() + [
      'jenis_belanja_id' => $jenis_belanja_id,
      'jb_fullkode' => $jb_fullkode,
    ]));
  }

  public function update(int|string $id, JenbelRequest $request): JenisBelanja
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

  public function getLevel3Jenbel(): Collection
  {
    return $this->repository->getLevel3Jenbel();
  }
}
