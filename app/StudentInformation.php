<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
  protected $guarded = [];

  public function education_background()
  {
    return $this->hasOne(EducationBackground::class);
  }

  public function emergency_contact()
  {
    return $this->hasOne(EmergencyContact::class);
  }
}
