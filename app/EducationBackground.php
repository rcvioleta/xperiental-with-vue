<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationBackground extends Model
{
  protected $guarded = [];

  public function student_information()
  {
    return $this->belongsTo(StudentInformation::class);
  }
}
