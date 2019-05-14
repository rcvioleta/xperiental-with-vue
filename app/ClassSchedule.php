<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function Opis\Closure\serialize;

class ClassSchedule extends Model
{
  protected $guarded = [];

  public function setStudentInformationIdAttribute($array)
  {
    $this->attributes['student_information_id'] = serialize($array);
  }
}
