<?php

namespace App\Http\Controllers;

use App\EducationBackground;
use Illuminate\Http\Request;
use App\Http\Resources\EducationBackgroundResource;

class EducationBackgroundController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $educationBackground = EducationBackground::all();
    return EducationBackgroundResource::collection($educationBackground);
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
      // 'name' => 'required | unique:education_backgrounds',
      'name' => 'required',
      'year_attended' => 'required',
      'notes' => 'required'
    ]);

    $educationBackground = EducationBackground::create($request->all());

    return response()->json([
      'update' => new EducationBackgroundResource($educationBackground),
      'message' => 'Successfully added Education Background',
      'newlist' => EducationBackground::where('student_id', $request->student_id)->orderBy('created_at', 'Desc')->get(),
      'status' => 200
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\EducationBackground  $educationBackground
   * @return \Illuminate\Http\Response
   */
  public function show(EducationBackground $educationBackground)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\EducationBackground  $educationBackground
   * @return \Illuminate\Http\Response
   */
  public function edit(EducationBackground $educationBackground)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\EducationBackground  $educationBackground
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {

    $educationBackground = EducationBackground::findOrFail($id);

    $educationBackground->fill($request->all())->push();

    return response()->json([
      'update' => new EducationBackgroundResource($educationBackground),
      'message' => 'Education Background was updated successfully!',
      'newlist' => EducationBackground::where('student_id', $request->student_id)->orderBy('created_at', 'Desc')->get(),
      'status' => 200
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\EducationBackground  $educationBackground
   * @return \Illuminate\Http\Response
   */
  public function destroy(EducationBackground $educationBackground)
  {
    $educationBackground->delete();
    return response()->json([
      'slug' => $educationBackground->slug,
      'message' => 'Successfully removed Education Background',
      'status' => 204
    ]);
  }
}
