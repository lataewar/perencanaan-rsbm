<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'route', 'icon', 'desc', 'menu_id'];

  public function menu()
  {
    return $this->belongsTo(Menu::class);
  }
}
