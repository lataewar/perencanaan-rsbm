<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'route', 'icon', 'desc', 'has_submenu'];

  public function subMenus()
  {
    return $this->hasMany(SubMenu::class);
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }
}
