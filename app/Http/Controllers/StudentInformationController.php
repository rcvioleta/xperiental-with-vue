<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentInformation;
use App\EducationBackground;
use App\Http\Resources\StudentInformationResource;
use App\Http\Requests\StudentInformationRequest;

class StudentInformationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $students_active = StudentInformation::where('status', '1')->orderBy('student_information.id_num')->get();
    $students_inactive = StudentInformation::where('status', '0')->orderBy('student_information.id_num')->get();

    $data = [
      'active' => $students_active,
      'inactive' => $students_inactive
    ];

    return $data;
  }

  protected function getStudentBackgroundEdu($id) {
    return EducationBackground::where('student_id', $id)->orderBy('created_at', 'Desc')->get();
  }

  protected function getStudents() {
    return StudentInformation::orderBy('student_information.id_num')->get();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // return view('admin.student.create');
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
      'id_num' => 'required|unique:student_information',
    ]);

    if($request->image != "" && $request->image != null) {

        $avatar = $request->image;
        $avatar_name = time() . $avatar->getClientOriginalName();

        $avatar->move('images/avatar/student', $avatar_name);
        $avatar_name = 'images/avatar/student/'.$avatar_name;
    }
    else {
        $avatar_name = 'images/avatar/student/avatar-default.png';  
    }

    $student = StudentInformation::create([
      'image' => $avatar_name,
      'id_num' => $request->id_num, 
      'first_name' => $request->first_name,
      'middle_name' => $request->middle_name,
      'last_name' => $request->last_name,
      'gender' => $request->gender,
      'birth_date' => $request->birth_date,
      'phone_number' => $request->phone_number,
      'address' => $request->address,
      'emcon_full_name' => $request->emcon_full_name,
      'emcon_phone_number' => $request->emcon_phone_number,
      'emcon_relationship' => $request->emcon_relationship,
      'emcon_address' => $request->emcon_address,
      'nickname' => $request->nickname,
      'registration_date' => $request->registration_date,
      'status' => $request->status
    ]);

    return $student;
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
    $student = StudentInformation::where('id', $id)->first();

    $eduBackgrounds = $this->getStudentBackgroundEdu($id);

    $data = [
      'student' => $student,
      'eduBackgrounds' => $eduBackgrounds,
    ];

    return $data;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\StudentInformation  $student
   * @return \Illuminate\Http\Response
   */
  public function update(StudentInformationRequest $request, $id)
  {
    $student = StudentInformation::findOrFail($id);

    if($request->hasFile('image')) {
        $avatar = $request->image;
        $avatar_name = time() . $avatar->getClientOriginalName();

        $avatar->move('images/avatar/student', $avatar_name);
        $avatar_name = 'images/avatar/student/'.$avatar_name;
    }
    else {
        $avatar_name = $request->image;  
    }

    $student->update([
      'image' => $avatar_name,
      'id_num' => $request->id_num, 
      'first_name' => $request->first_name,
      'middle_name' => $request->middle_name,
      'last_name' => $request->last_name,
      'gender' => $request->gender,
      'birth_date' => $request->birth_date,
      'phone_number' => $request->phone_number,
      'address' => $request->address,
      'emcon_full_name' => $request->emcon_full_name,
      'emcon_phone_number' => $request->emcon_phone_number,
      'emcon_relationship' => $request->emcon_relationship,
      'emcon_address' => $request->emcon_address,
      'nickname' => $request->nickname,
      'registration_date' => $request->registration_date,
      'status' => $request->status
    ]);

    return $student;
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
