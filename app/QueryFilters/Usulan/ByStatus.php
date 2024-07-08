<?php

namespace App\QueryFilters\Usulan;

use App\QueryFilters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class ByStatus extends BaseFilter
{
  public function __construct()
  {
    parent::__construct('session', 'utable.status');
  }

  protected function applyFilter(Builder $builder): Builder
  {
    return $builder->where('statuses.status', $this->getData());
  }
}
