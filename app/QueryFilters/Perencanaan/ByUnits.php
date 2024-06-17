<?php

namespace App\QueryFilters\Perencanaan;

use App\QueryFilters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class ByUnits extends BaseFilter
{
  public function __construct()
  {
    parent::__construct('session', 'ptable.units');
  }

  protected function applyFilter(Builder $builder): Builder
  {
    return $builder->where('u.id', $this->getData());
  }
}
