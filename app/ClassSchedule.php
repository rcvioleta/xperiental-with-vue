<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function Opis\Closure\serialize;

class ClassSchedule extends Model
{
  protected $guarded = [];

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }
}
