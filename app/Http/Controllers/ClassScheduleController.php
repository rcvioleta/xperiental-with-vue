<?php

namespace App\Http\Controllers;

use App\ClassSchedule;
use App\StudentInformation;
use App\ClassRate;
use App\Subject;
use App\Classroom;
use App\ClassStudent;
use App\Instructor;
use App\StudentLevel;
use Illuminate\Http\Request;
use App\Http\Resources\ClassScheduleResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Collections\ClassScheduleCollection;
use App\Http\Requests\ClassScheduleRequest;
use Illuminate\Support\Carbon;

class ClassScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $schedules = $this->getSchedules();
    $students = StudentInformation::orderBy('last_name')->get();
    $classtypes = ClassRate::get();
    $grades = StudentLevel::get();
    $subjects = Subject::get();
    $instructors = Instructor::get();

    $data = [
      'schedules' => $schedules,
      'students' => $students,
      'classtypes' => $classtypes,
      'grades' => $grades,
      'subjects' => $subjects,
      'instructors' => $instructors,
    ];
    return $data;
  }

  protected function getSchedules() {
    return ClassSchedule::join('instructors', 'instructors.id', 'instructor_id')
      ->join('student_levels', 'student_levels.id', 'grade_id')
      ->select('class_schedules.*', 'instructors.nickname as instructor_nickname', 'first_name', 'middle_name', 'last_name', 'student_levels.name as grade_name')
      ->get();
  }

  protected function getStudentByClass($id)
  {
    return ClassStudent::where('class_schedules_id', $id)
            ->join('student_information', 'student_information.id', 'class_students.student_id')
            ->select('class_schedules_id','class_students_id', 'credits', 'student_id', 'first_name', 'middle_name', 'last_name', 'nickname')
            ->get();
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
   * @param  App\Http\Requests\ClassScheduleRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $class_type = ClassRate::select('rate')->where('id', $request->classType)->get();

    $credit_cost = $class_type[0]->rate * $request->credits;

    $students = [];

    $otherstudents = [];


    $newSchedule = ClassSchedule::create([
      'date_start' => $request->startTimeFull,
      'date_end' => $request->endTimeFull,
      'instructor_id' => $request->instructor_id,
      'class_rate_id' => $request->classType,
      'credit_cost' => $credit_cost,
      'subject_id' => $request->subject,
      'grade_id' => $request->grade_id,
      'status' => $request->status,
    ]);


    foreach ( $request->students as $student) {
      $students[] = [
        'student_id' => $student,
        'class_schedules_id' => $newSchedule->id,
        'credits' => $request->credits,
      ];
    }

    ClassStudent::insert($students);


    //This is for multiple dates
    if($request->checkMultiple == '1') {

      $start = Carbon::parse($request->startTimeFull)->format('H:i:s');
      $end = Carbon::parse($request->endTimeFull)->format('H:i:s');

      foreach ( $request->otherClassDate as $classdate) {

        $newSchedule = ClassSchedule::create([
          'date_start' => $classdate.'T'.$start,
          'date_end' => $classdate.'T'.$end,
          'instructor_id' => $request->instructor_id,
          'class_rate_id' => $request->classType,
          'credit_cost' => $credit_cost,
          'subject_id' => $request->subject,
          'grade_id' => $request->grade_id,
          'status' => $request->status,
        ]);

        foreach ($request->students as $student) {
          $otherstudents[] = [
            'student_id' => $student,
            'class_schedules_id' => $newSchedule->id,
            'credits' => $request->credits,
          ];
        }

      }


      ClassStudent::insert($otherstudents);

    }

    return response()->json([
      'message' => 'Successfully added New Schedule',
      'newlist' => $this->getSchedules(),
      'status' => 200,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\ClassSchedule  $classSchedule
   * @return \Illuminate\Http\Response
   */
  public function show(ClassSchedule $classSchedule)
  { }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\ClassSchedule  $classSchedule
   * @return \Illuminate\Http\Response
   */
  public function edit(ClassSchedule $classSchedule)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    ClassStudent::where('class_schedules_id', $id)->delete();

    $classSchedule = ClassSchedule::findOrFail($id);

    $class_type = ClassRate::select('rate')->where('id', $request->classType)->get();
    $credit_cost = $class_type[0]->rate * $request->credits;

    $classSchedule->fill([
      'date_start' => $request->startTimeFull,
      'date_end' => $request->endTimeFull,
      'instructor_id' => $request->instructor_id,
      'class_rate_id' => $request->classType,
      'credit_cost' => $credit_cost,
      'subject_id' => $request->subject,
      'grade_id' => $request->grade_id,
      'status' => $request->status,
    ])->push();

    $students = [];

    foreach ( $request->students as $student) {
      $students[] = [
        'student_id' => $student,
        'class_schedules_id' => $id,
        'credits' => $request->credits,
      ];
    }

    ClassStudent::insert($students);

    return response()->json([
      'message' => 'Successfully updated Class Schedule',
      'newlist' => $this->getSchedules(),
      'status' => 200
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    ClassSchedule::destroy($id);
    ClassStudent::where('class_schedules_id', $id)->delete();

    return response()->json([
      'message' => 'Successfully deleted Class Schedule',
      'newlist' => $this->getSchedules(),
      'status' => 200
    ]);
  }

}
