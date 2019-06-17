<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
  protected $guarded = [];

  public function student_information()
  {
    return $this->belongsTo(StudentInformation::class);
  }
}
