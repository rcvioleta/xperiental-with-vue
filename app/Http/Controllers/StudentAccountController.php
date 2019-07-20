<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentInformation;
use App\StudentAccount;
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
        $data = $this->getListData();

        return view('admin.student-account.index', [
          'data' => $data,
        ]);
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
        $student = StudentInformation::where('id', $id)->first();

        $classSchedules = $this->getStudentClassSchedule($id);

        $accounts = $this->getStudentAccounts($id);

        return view('admin.student-account.edit', [
          'student' => $student,
          'classSchedules' => $classSchedules,
          'accounts' => $accounts
        ]);
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

    protected function getListData() {

        $std = StudentInformation::groupBy('id')
            ->leftJoin('enrollments', 'enrollments.student_id', 'student_information.id')
            ->selectRaw('id, id_num, first_name, middle_name, last_name, gender, nickname, registration_date, birth_date, student_information.created_at as created_at, SUM(credits) as credits')
            ->orderBy('student_information.id_num', 'desc')
            ->get();

        $credits_used = ClassStudent::groupBy('student_id')
            ->selectRaw('class_students_id, student_id, SUM(credits) as credits_used')
            ->get();

        $getListData = [
            'student' => $std,
            'credits_used' => $credits_used
        ];

        return $getListData;
    }

    protected function getStudentClassSchedule($id) {
        return ClassStudent::join('class_schedules', 'class_students.class_schedules_id', 'class_schedules.id')
            ->join('class_rates', 'class_rates.id', 'class_schedules.class_rate_id')
            ->join('subjects', 'subjects.id', 'class_schedules.subject_id')
            ->join('instructors', 'instructors.id', 'class_schedules.instructor_id')
            ->select('class_schedules.*', 'credits', 'class_rates.name as class_type', 'subjects.name as subject', 'first_name', 'middle_name', 'last_name', 'class_schedules.status as status')
            ->where('student_id', $id)
            ->orderBy('class_students.class_students_id', 'Desc')
            ->get();
    }

    protected function getStudentAccounts($id) {
        return StudentAccount::where('student_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
