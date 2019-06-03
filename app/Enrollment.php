<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = "enrollment_id";
    // protected $fillable = [
    // 	'transaction_number', 
    // 	'user_id', 
    // 	'nsc_id', 
    // 	'eta_rct', 
    // 	'client_number', 
    // 	'b3_lines', 
    // 	'step_type', 
    // 	'step_explaination_id', 
    // 	'step_remarks', 
    // 	'entry_type_id', 
    // 	'release_status_id', 
    // 	'edi', 
    // 	'swi_across', 
    // 	'across_reason',
    // 	'difficulty_level', 
    // 	'difficulty_level_reason_id',
    //     'total_edit_attempt',
    //     'holdreason_id',
    //     'holdremarks'
    // ];


    protected $guarded = [];
}
