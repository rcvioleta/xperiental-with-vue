<?php

namespace App\Http\Controllers;

use App\StudentLevel;
use Illuminate\Http\Request;
use App\Http\Resources\StudentLevelResource;

class StudentLevelController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $studentLevels = StudentLevel::all();
    return StudentLevelResource::collection($studentLevels);
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
    $studentLevel = StudentLevel::create([
      'name' => $request->grade_name,
      'status' => $request->grade_status
    ]);

    return response()->json([
      'newlist' => StudentLevel::all(),
      'message' => 'Student Level was updated successfully!',
      'status' => 200
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\StudentLevel  $studentLevel
   * @return \Illuminate\Http\Response
   */
  public function show(StudentLevel $studentLevel)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\StudentLevel  $studentLevel
   * @return \Illuminate\Http\Response
   */
  public function edit(StudentLevel $studentLevel)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\StudentLevel  $studentLevel
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $studentLevel = StudentLevel::findOrFail($id);

    $studentLevel->update([
      'name' => $request->grade_name,
      'status' => $request->grade_status
    ]);

    return response()->json([
      'newlist' => StudentLevel::all(),
      'message' => 'Student Level was updated successfully!',
      'status' => 200
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\StudentLevel  $studentLevel
   * @return \Illuminate\Http\Response
   */
  public function destroy(StudentLevel $studentLevel)
  {
    $studentLevel->delete();
    return response()->json([
      'slug' => $studentLevel->slug,
      'message' => 'Student Level was deleted!',
      'status' => 204
    ]);
  }
}
