<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRate extends Model
{
  protected $guarded = [];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function setSlugAttribute($slug)
  {
    $this->attributes['slug'] = str_slug($slug);
  }
}
