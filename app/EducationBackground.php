<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationBackground extends Model
{
  protected $guarded = [];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function student_information()
  {
    return $this->belongsTo(StudentInformation::class);
  }

  public function setSlugAttribute($value)
  {
    $this->attributes['slug'] = str_slug($value);
  }
}
