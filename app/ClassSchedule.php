<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
  protected $guarded = [];

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function classroom()
  {
    return $this->belongsTo(Classroom::class);
  }
}
