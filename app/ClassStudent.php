<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    protected $table = 'class_students';
    protected $primaryKey = "class_students_id";
    protected $guarded = [];
}
