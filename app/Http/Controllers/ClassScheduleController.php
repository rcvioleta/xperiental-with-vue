<?php

namespace App\Http\Controllers;

use App\ClassSchedule;
use Illuminate\Http\Request;
use App\Http\Resources\ClassScheduleResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Collections\ClassScheduleCollection;

class ClassScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return ClassScheduleResource::collection(ClassSchedule::all());
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
    return response()->json([
      'data' => new ClassScheduleResource($newSchedule)
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
