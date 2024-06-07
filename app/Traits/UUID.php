<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UUID
{
  protected static function boot(): void
  {
    // Boot other traits on the Model
    parent::boot();

    /**
     * Listen for the creating event on the Model.
     * Sets the 'id' to a UUID using Str::uuid() on the instance being created
     */
    static::creating(function ($model) {
      if ($model->getKey() === null) {
        $model->setAttribute($model->getKeyName(), Str::uuid());
      }
    });
  }

  // Tells the database not to auto-increment this field
  public function getIncrementing(): bool
  {
    return false;
  }

  // Helps the application to specify the field type in the database
  public function getKeyType(): string
  {
    return 'string';
  }
}

/* old ways

  protected $keyType = 'string';
  public $incrementing = false;
  public static function booted()
  {
    static::creating(function ($model) {
      $model->id = \Illuminate\Support\Str::uuid();
    });
  }
  */
