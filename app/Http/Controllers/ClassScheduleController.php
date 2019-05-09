<?php

namespace App\Http\Controllers;

use App\ClassSchedule;
use Illuminate\Http\Request;
use Calendar;
use App\StudentInformation;

class ClassScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $events = ClassSchedule::get();
    $eventList = [];
    foreach ($events as $key => $event) {
      $eventList[] = Calendar::event(
        $event->event_name,
        true,
        new \DateTime($event->start_date),
        new \DateTime($event->end_date . '+1 day')
      );
    }

    $calendarDetails = Calendar::addEvents($eventList);

    $students = StudentInformation::get();

    return view('admin.class-calendar', ['calendarDetails' => $calendarDetails, 'students' => $students]);
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
    $request->validate([
      'class_date' => 'required',
      'start_time' => 'required',
      'end_time' => 'required',
      'class_rate' => 'required',
      'subject' => 'required',
      'classroom' => 'required',
      'status' => 'required'
    ]);

    return response()->json(['requests' => $request->all()]);
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
   * @param  \App\ClassSchedule  $classSchedule
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ClassSchedule $classSchedule)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\ClassSchedule  $classSchedule
   * @return \Illuminate\Http\Response
   */
  public function destroy(ClassSchedule $classSchedule)
  {
    //
  }
}
