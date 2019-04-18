<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;
use App\Http\Resources\ClassroomResource;

class ClassroomController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return ClassroomResource::collection(Classroom::all());
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
    Classroom::create($request->all());
    return response('Classroom saved', 200);
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

  public function active($slug)
  {
    $classroom = Classroom::where('slug', '=', $slug)->first();
    $classroom->status = 1;
    $classroom->save();
    return response('Updated status to active', 200);
  }

  public function inactive($slug)
  {
    $classroom = Classroom::where('slug', '=', $slug)->first();
    $classroom->status = 0;
    $classroom->save();
    return response('Updated status to inactive', 200);
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
  public function update(Request $request, Classroom $classroom)
  {
    $classroom->update($request->all());

    $update = [
      'id' => $classroom->id,
      'name' => $classroom->name,
      'slug' => $classroom->slug,
      'status' => $classroom->status
    ];

    return response()->json([
      'update' => $update,
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
