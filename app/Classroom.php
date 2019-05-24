<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
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

  public function class_schedules()
  {
    return $this->hasMany(ClassSchedule::class);
  }
}
