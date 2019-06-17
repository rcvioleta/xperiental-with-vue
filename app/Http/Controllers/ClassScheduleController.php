<?php

namespace App\Http\Controllers;

use App\ClassSchedule;
use App\StudentInformation;
use App\ClassRate;
use App\Subject;
use App\Classroom;
use App\ClassStudent;
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
      'classrooms' => $this->getClassrooms(),
      'subjects' => $this->getSubjects(),
    ]);
  }

  protected function getSchedules() {
    return ClassSchedule::get();
  }

  protected function getStudents()
  {
    return StudentInformation::get();
  }

  protected function getClassTypes()
  {
    return ClassRate::get();
  }

  protected function getClassrooms()
  {
    return Classroom::get();
  }

  protected function getSubjects()
  {
    return Subject::get();
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
    // $newSchedule = ClassSchedule::create($request->all());
    // return response()->json([
    //   'data' => new ClassScheduleResource($newSchedule)
    // ]);

    $newSchedule = ClassSchedule::create([
      'date_start' => $request->startTimeFull,
      'date_end' => $request->endTimeFull,
      'instructor_id' => 12,
      'class_rate_id' => $request->classType,
      'subject_id' => $request->subject,
      'classroom_id' => $request->classroom,
      'status' => $request->status,
    ]);

    $schedId = new ClassScheduleResource($newSchedule);

    $students = [];

    foreach ( $request->students as $student) {
      $students[] = [
        'student_id' => $student,
        'class_schedules_id' => $schedId->id,
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
    $request['subject_id'] = $request->subject;
    unset($request['subject']);
    $classSchedule = ClassSchedule::find($id);
    $classSchedule->update($request->all());
    $classSchedule['subject'] = $classSchedule['subject_id'];
    unset($classSchedule['subject_id']);

    // return response($classSchedule);

    return response()->json([
      'update' => new ClassScheduleCollection($classSchedule),
      'message' => 'Successfully updated class schedule',
      'status' => Response::HTTP_ACCEPTED
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
    return response()->json([
      'removedId' => $id,
      'message' => 'Class Schedule was removed successfully',
      'status' => Response::HTTP_NO_CONTENT
    ]);
  }
}
