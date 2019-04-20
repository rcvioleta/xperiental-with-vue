<?php

namespace App\Http\Controllers;

use App\ClassRate;
use Illuminate\Http\Request;
use App\Http\Resources\ClassRateResource;

class ClassRateController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return ClassRateResource::collection(ClassRate::all());
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
    $classRate = ClassRate::create($request->all());

    $update = [
      'name' => $classRate->name,
      'slug' => $classRate->slug,
      'rate' => $classRate->rate,
      'status' => $classRate->status
    ];

    return response()->json([
      'update' => $update,
      'message' => 'Class Rate added successfully!',
      'status' => 200
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\ClassRate  $classRate
   * @return \Illuminate\Http\Response
   */
  public function show(ClassRate $classRate)
  {
    //
  }

  public function active($slug)
  {
    $classRate = ClassRate::where('slug', '=', $slug)->first();
    $classRate->status = 1;
    $classRate->save();
    return response('Updated status to active', 200);
  }

  public function inactive($slug)
  {
    $classRate = ClassRate::where('slug', '=', $slug)->first();
    $classRate->status = 0;
    $classRate->save();
    return response('Updated status to inactive', 200);
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\ClassRate  $classRate
   * @return \Illuminate\Http\Response
   */
  public function edit(ClassRate $classRate)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\ClassRate  $classRate
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ClassRate $classRate)
  {
    $classRate->update($request->all());

    $update = [
      'name' => $classRate->name,
      'slug' => $classRate->slug,
      'rate' => $classRate->rate,
      'status' => $classRate->status
    ];

    return response()->json([
      'update' => $update,
      'message' => 'Class Rate was updated successfully!',
      'status' => 200
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\ClassRate  $classRate
   * @return \Illuminate\Http\Response
   */
  public function destroy(ClassRate $classRate)
  {
    $classRate->delete();
    return response()->json([
      'slug' => $classRate->slug,
      'message' => 'Class Rate was deleted!',
      'status' => 204
    ]);
  }
}
