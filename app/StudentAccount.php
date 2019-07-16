<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    protected $table = 'student_accounts';
    protected $primaryKey = "student_account_id";
    protected $guarded = [];
}
