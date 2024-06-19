<?php

namespace App\Services;

use App\Http\Requests\BelanjaRequest;
use App\Models\Belanja;
use App\Repositories\BelanjaRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use stdClass;

class BelanjaService extends BaseService
{
  public function __construct(
    protected BelanjaRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function table(string $id): Collection
  {
    $repos = $this->repository->table($id);

    $jenbels = new Collection();

    foreach ($repos as $repo) {

      // Jika JENBEL UTAMA masih kosong / perulangan pertama dari data repo
      if (count($jenbels) == 0) {
        $jenbels->push($this->getArray($repo, 1));

        $jenbels1 = $jenbels->first(fn($x) => $x->id == $repo->jb1_id);
        $jenbels1->jenis_belanjas->push($this->getArray($repo, 2));

        $jenbels2 = $jenbels1->jenis_belanjas->first(fn($x) => $x->id == $repo->jb2_id);
        $jenbels2->jenis_belanjas->push($this->getArray($repo, 3));

      } else { // Repo Ke 2 dan seterusnya
        //
        // Cek apakah jenis_belanja_level_1_id repo sudah ada di koleksi baru
        $jenbel1 = $jenbels->first(fn($x) => $x->id == $repo->jb1_id);
        if ($jenbel1) { // Jika jenis_belanja_level_1_id repo SUDAH ada

          // Cek apakah jenis_belanja_level_2_id repo sudah ada di koleksi baru level 2
          $jenbel2 = $jenbel1->jenis_belanjas->first(fn($x) => $x->id == $repo->jb2_id);
          if ($jenbel2) { // Jika jenis_belanja_level_2_id repo SUDAH ada

            $jenbel2->jenis_belanjas->push($this->getArray($repo, 3));

          } else { // Jika jenis_belanja_level_2_id repo BELUM ada
            $jenbel1->jenis_belanjas->push($this->getArray($repo, 2));

            $jenbels2 = $jenbel1->jenis_belanjas->first(fn($x) => $x->id == $repo->jb2_id);
            $jenbels2->jenis_belanjas->push($this->getArray($repo, 3));
          }


        } else { // Jika jenis_belanja_level_1_id repo BELUM ada
          $jenbels->push($this->getArray($repo, 1));

          $jenbels1 = $jenbels->first(fn($x) => $x->id == $repo->jb1_id);
          $jenbels1->jenis_belanjas->push($this->getArray($repo, 2));

          $jenbels2 = $jenbels1->jenis_belanjas->first(fn($x) => $x->id == $repo->jb2_id);
          $jenbels2->jenis_belanjas->push($this->getArray($repo, 3));
        }
      }
    }

    return $jenbels;
  }

  private function getArray(Model $model, int $lvl): stdClass
  {
    switch ($lvl) {
      case 1:
        return (object) [
          "id" => $model->jb1_id,
          "jb_name" => $model->jb1_name,
          "jb_kode" => $model->jb1_kode,
          "jb_fullkode" => $model->jb1_fullkode,
          "jb_level" => $model->jb1_level,
          "jenis_belanjas" => collect(),
        ];
      case 2;
        return (object) [
          "id" => $model->jb2_id,
          "jb_name" => $model->jb2_name,
          "jb_kode" => $model->jb2_kode,
          "jb_fullkode" => $model->jb2_fullkode,
          "jb_level" => $model->jb2_level,
          "jenis_belanjas" => collect(),
        ];
      case 3;
        return (object) [
          "id" => $model->jb3_id,
          "jb_name" => $model->jb3_name,
          "jb_kode" => $model->jb3_kode,
          "jb_fullkode" => $model->jb3_fullkode,
          "jb_level" => $model->jb3_level,
          "belanja_id" => $model->id,
          "belanja_desc" => $model->b_desc,
          "sumber_anggaran" => $model->b_sumber_anggaran,
          "barangs" => $model->barangs,
          "total_harga" => $model->total_harga,
        ];

      default:
        return (object) [];
    }
  }

  public function store(BelanjaRequest $request): Belanja
  {
    return $this->repository->store((object) $request->validated());
  }

  public function find_edit(string $id): ?Model
  {
    return $this->repo->find_edit($id);
  }

  public function update(string $id, BelanjaRequest $request): Belanja
  {
    return $this->repository->update($id, (object) $request->validated());
  }

}
