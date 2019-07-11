<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentInformation;
use App\ClassStudent;

class StudentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->getStudents();

        return view('admin.student-account.index', [
          'students' => $students,
        ]);
    }

    protected function getStudents() {

        $std = StudentInformation::groupBy('id')
            ->leftJoin('enrollments', 'enrollments.student_id', 'student_information.id')
            ->selectRaw('id, id_num, first_name, middle_name, last_name, gender, nickname, registration_date, birth_date, student_information.created_at as created_at, SUM(credits) as credits')
            ->orderBy('student_information.id_num', 'desc')
            ->get();

        $credits_used = ClassStudent::groupBy('student_id')
            ->selectRaw('class_students_id, student_id, SUM(credits) as credits_used')
            ->get();

        $students[] = [
            'student' => $std,
            'credits_used' => $credits_used
        ];

        return $students;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
