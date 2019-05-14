<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Resources\SubjectResource;

class SubjectController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return SubjectResource::collection(Subject::all());
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  { }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $subject = Subject::create($request->all());

    return response()->json([
      'update' => new SubjectResource($subject),
      'message' => 'Subject added successfully!',
      'status' => 200
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Subject  $subject
   * @return \Illuminate\Http\Response
   */
  public function show(Subject $subject)
  {
    return new SubjectResource($subject);
  }

  public function active($slug)
  {
    $subject = Subject::where('slug', '=', $slug)->first();
    $subject->status = 1;
    $subject->save();
    return response()->json([
      'updatedStatus' => $subject->status,
      'message' => 'Updated status to active',
      'status' => 200
    ]);
  }

  public function inactive($slug)
  {
    $subject = Subject::where('slug', '=', $slug)->first();
    $subject->status = 0;
    $subject->save();
    return response()->json([
      'updatedStatus' => $subject->status,
      'message' => 'Updated status to active',
      'status' => 200
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Subject  $subject
   * @return \Illuminate\Http\Response
   */
  public function edit(Subject $subject)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Subject  $subject
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Subject $subject)
  {
    $subject->update($request->all());

    return response()->json([
      'update' => new SubjectResource($subject),
      'message' => 'Subject was updated successfully!',
      'status' => 200
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Subject  $subject
   * @return \Illuminate\Http\Response
   */
  public function destroy(Subject $subject)
  {
    $subject->delete();
    return response()->json([
      'slug' => $subject->slug,
      'message' => 'Subject was deleted!',
      'status' => 204
    ]);
  }
}
