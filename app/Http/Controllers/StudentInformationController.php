<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentInformation;
use App\Http\Resources\StudentInformationResource;

class StudentInformationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $students = StudentInformation::all();
    return StudentInformationResource::collection($students);
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
    $student = StudentInformation::create($request->all());
    return response()->json([
      'insertedId' => $student->id,
      'message' => 'Successfully saved student information',
      'status' => 200
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\StudentInformation  $student
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, StudentInformation $student)
  {
    $student->update($request->all());

    $update = [
      'first_name' => $student->first_name,
      'middle_name' => $student->last_name,
      'last_name' => $student->middle_name,
      'gender' => $student->gender,
      'birth_date' => $student->birth_date,
      'phone_number' => $student->phone_number,
      'address' => $student->address
    ];

    return response()->json([
      'update' => $update,
      'message' => 'Student Information was updated successfully!',
      'status' => 200
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\StudentInformation  $student
   * @return \Illuminate\Http\Response
   */
  public function destroy(StudentInformation $student)
  {
    $student->delete();
    return response()->json([
      'slug' => $student->id,
      'message' => 'Student information was deleted!',
      'status' => 204
    ]);
  }
}
