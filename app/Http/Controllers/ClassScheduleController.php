<?php

namespace App\Http\Controllers;

use App\ClassSchedule;
use Illuminate\Http\Request;
use Calendar;
use App\StudentInformation;
use App\Http\Resources\ClassScheduleResource;
use Symfony\Component\HttpFoundation\Response;

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
    $currentSubject = '';
    $currentStartTime = '';
    $currentEndTime = '';
    foreach ($events as $key => $event) {
      if ($event->subject->name != $currentSubject && $event->start_time != $currentStartTime && $event->end_time != $currentEndTime) {
        $eventList[] = Calendar::event(
          $event->subject->name . ' ' . $event->start_time . '-' . $event->end_time,
          true,
          new \DateTime($event->class_date),
          new \DateTime($event->class_date . '+1 day')
        );
      }
      $currentSubject = $event->subject->name;
      $currentStartTime = $event->start_time;
      $currentEndTime = $event->end_time;
    }

    $calendarDetails = Calendar::addEvents($eventList);
    return view('admin.class-calendar', ['calendarDetails' => $calendarDetails]);
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
    // return response()->json(['requests' => $request->all()]);
    $newSchedule = ClassSchedule::create($request->all());
    return response([
      'data' => new ClassScheduleResource($newSchedule)
    ], Response::HTTP_CREATED);
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
