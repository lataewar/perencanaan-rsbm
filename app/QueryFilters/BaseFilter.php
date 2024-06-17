<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

abstract class BaseFilter
{
  public function __construct(
    protected string $from,
    protected string $data
  ) {
  }

  public function handle(Builder $builder, Closure $next): Builder
  {
    if (
      ($this->from == 'session' && !Session::has($this->data))
      || ($this->from == 'request' && !request()->has($this->data))
    )
      return $next($builder);

    return $this->applyFilter($next($builder));
  }

  protected abstract function applyFilter(Builder $builder): Builder;

  protected function getData(): string
  {
    return $this->from == "session" ?
      session()->get($this->data) :
      request($this->data);
  }
}
