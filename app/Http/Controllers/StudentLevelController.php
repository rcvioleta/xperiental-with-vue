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
    //
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
  public function update(Request $request, StudentLevel $studentLevel)
  {
    $studentLevel->update($request->all());

    $update = [
      'id' => $studentLevel->id,
      'level_name' => $studentLevel->level_name,
      'slug' => $studentLevel->slug,
      'status' => $studentLevel->status
    ];

    return response()->json([
      'update' => $update,
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
