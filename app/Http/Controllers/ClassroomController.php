<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return Classroom::all();
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
    $classroom = Classroom::create([
      'name' => $request->classroom_name,
      'status' => $request->classroom_status
    ]);

    return response()->json([
      'newlist' => Classroom::all(),
      'message' => 'Classroom added successfully!',
      'status' => 200
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Classroom  $classroom
   * @return \Illuminate\Http\Response
   */
  public function show(Classroom $classroom)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Classroom  $classroom
   * @return \Illuminate\Http\Response
   */
  public function edit(Classroom $classroom)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Classroom  $classroom
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $classroom = classroom::findOrFail($id);

    $classroom->update([
      'name' => $request->classroom_name,
      'status' => $request->classroom_status
    ]);

    return response()->json([
      'newlist' => Classroom::all(),
      'message' => 'Classroom was updated successfully!',
      'status' => 200
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Classroom  $classroom
   * @return \Illuminate\Http\Response
   */
  public function destroy(Classroom $classroom)
  {
    $classroom->delete();
    return response()->json([
      'slug' => $classroom->slug,
      'message' => 'Classroom was deleted!',
      'status' => 204
    ]);
  }
}
