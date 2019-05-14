<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
  protected $guarded = [];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function class_schedules()
  {
    return $this->hasMany(ClassSchedule::class);
  }

  public function setSlugAttribute($value)
  {
    $this->attributes['slug'] = str_slug($value);
  }
}
