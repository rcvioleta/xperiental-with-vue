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
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required|numeric|max:1|digits:1'
    ]);

    $studentLevel = StudentLevel::create($request->all());

    return response()->json([
      'update' => new StudentLevelResource($studentLevel),
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

  public function active($slug)
  {
    $studentLevel = StudentLevel::where('slug', '=', $slug)->first();
    $studentLevel->status = 1;
    $studentLevel->save();
    return response('Updated status to active', 200);
  }

  public function inactive($slug)
  {
    $studentLevel = StudentLevel::where('slug', '=', $slug)->first();
    $studentLevel->status = 0;
    $studentLevel->save();
    return response('Updated status to inactive', 200);
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
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required|numeric|max:1|digits:1'
    ]);

    $studentLevel->update($request->all());

    return response()->json([
      'update' => new StudentLevelResource($studentLevel),
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
