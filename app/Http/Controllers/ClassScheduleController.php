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

class ClassScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // return ClassScheduleResource::collection(ClassSchedule::all());
    return view('admin.class-schedule.index', [
      'schedules' => $this->getSchedules(),
      'students' => $this->getStudents(),
      'classtypes' => $this->getClassTypes(),
      'grades' => $this->getGrades(),
      'subjects' => $this->getSubjects(),
      'instructors' => $this->getInstructors(),
    ]);
  }

  protected function getSchedules() {
    return ClassSchedule::join('instructors', 'instructors.id', 'instructor_id')
      ->join('student_levels', 'student_levels.id', 'grade_id')
      ->select('class_schedules.*', 'instructors.nickname as instructor_nickname', 'first_name', 'middle_name', 'last_name', 'student_levels.name as grade_name')
      ->get();
  }

  protected function getStudents()
  {
    return StudentInformation::orderBy('last_name')->get();
  }

  protected function getClassTypes()
  {
    return ClassRate::get();
  }

  protected function getGrades()
  {
    return StudentLevel::get();
  }

  protected function getSubjects()
  {
    return Subject::get();
  }

  protected function getInstructors()
  {
    return Instructor::get();
  }

  protected function getStudentByClass($id)
  {
    return ClassStudent::where('class_schedules_id', $id)->get();
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

    $schedId = new ClassScheduleResource($newSchedule);

    $students = [];

    foreach ( $request->students as $student) {
      $students[] = [
        'student_id' => $student,
        'class_schedules_id' => $schedId->id,
        'credits' => $request->credits,
      ];
    }

    ClassStudent::insert($students);

    return response()->json([
      'update' => $schedId,
      'message' => 'Successfully added New Schedule',
      'newlist' => $this->getSchedules(),
      'status' => 200
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
