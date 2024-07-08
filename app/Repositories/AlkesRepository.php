<?php

namespace App\Repositories;

use App\Models\AlkesFormat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AlkesRepository extends BaseRepository
{
  public function __construct(AlkesFormat $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder|Model
  {
    return $this->model->query();
  }

}
