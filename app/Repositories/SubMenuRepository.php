<?php

namespace App\Repositories;

use App\Models\SubMenu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class SubMenuRepository extends BaseRepository
{
  public function __construct(SubMenu $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(int $id): Builder|Model
  {
    return $this->model->where('menu_id', $id);
  }

  public function show(int|string $id): SubMenu
  {
    return $this->model->findOrFail($id);
  }

  public function store(stdClass $request): SubMenu
  {
    return $this->model->create([
      'name' => $request->name,
      'route' => $request->route,
      'icon' => $request->icon,
      'desc' => $request->desc,
      'menu_id' => $request->menu_id,
    ]);
  }

  public function update(int $id, stdClass $request): SubMenu
  {
    $model = $this->find($id);
    return tap($model)->update([
      'name' => $request->name,
      'route' => $request->route,
      'icon' => $request->icon,
      'desc' => $request->desc,
    ]);
  }
}
