<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\StudentLevel;
use App\Classroom;
use App\ClassRate;
use App\User;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::all();
        $studentLevel = StudentLevel::all();
        $classroom = Classroom::all();
        $classRate = ClassRate::all();
        $user = User::all();

        $data = [
            'subject' => $subject,
            'studentLevel' => $studentLevel,
            'classroom' => $classroom,
            'classRate' => $classRate,
            'user' => $user
        ];

        return $data;
    }
}
