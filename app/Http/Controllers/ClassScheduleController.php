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
    return view('admin.class-calendar');
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
