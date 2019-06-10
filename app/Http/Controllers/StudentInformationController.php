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
    // return StudentInformationResource::collection($students);
    return view('admin.student.index', [
      'students' => $students,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.student.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // $student = StudentInformation::create($request->all());
    // return response()->json([
    //   'insertedId' => $student->id,
    //   'message' => 'Successfully saved student information',
    //   'status' => 200
    // ]);

    StudentInformation::create([
      'id_num' => $request->get('id_num'),
      'first_name' => $request->get('first_name'),
      'middle_name' => $request->get('middle_name'),
      'last_name' => $request->get('last_name'),
      // 'gender' => $request->get('gender'),
      'birth_date' => $request->get('birth_date'),
      'phone_number' => $request->get('phone_number'),
      'address' => $request->get('address'),
      'emcon_full_name' => $request->get('emcon_full_name'),
      'emcon_phone_number' => $request->get('emcon_phone_number'),
      'emcon_relationship' => $request->get('emcon_relationship'),
      'emcon_address' => $request->get('emcon_address'),
      'status' => true,
    ]);

    // echo $request; die;

    return redirect()->back()->with('message', 'Student Record for ID# '.$request->get('id_num').' '.$request->get('first_name').' '.$request->get('middle_name').' '.$request->get('last_name').' was successfully saved.');
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

    return response()->json([
      'update' => new StudentInformationResource($student),
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
