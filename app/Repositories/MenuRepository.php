<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class MenuRepository extends BaseRepository
{
  public function __construct(Menu $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): Menu
  {
    return $this->model->create([
      'name' => $request->name,
      'route' => $request->route,
      'icon' => $request->icon,
      'desc' => $request->desc,
      'has_submenu' => $request->has_submenu,
    ]);
  }

  public function update(int $id, stdClass $request): Menu
  {
    $model = $this->find($id);
    return tap($model)->update([
      'name' => $request->name,
      'route' => $request->route,
      'icon' => $request->icon,
      'desc' => $request->desc,
      'has_submenu' => $request->has_submenu,
    ]);
  }

  public function all(): Collection
  {
    return $this->model->select(['id', 'name'])->get();
  }
}
