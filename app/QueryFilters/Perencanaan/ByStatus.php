<?php

namespace App\QueryFilters\Perencanaan;

use App\QueryFilters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class ByStatus extends BaseFilter
{
  public function __construct()
  {
    parent::__construct('session', 'ptable.status');
  }

  protected function applyFilter(Builder $builder): Builder
  {
    return $builder->where('statuses.status', $this->getData());
  }
}
