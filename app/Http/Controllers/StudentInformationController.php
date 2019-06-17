<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentInformation;
use App\EducationBackground;
use App\Enrollment;
use App\ClassSchedule;
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
    $students = StudentInformation::all();
    // return StudentInformationResource::collection($students);
    return view('admin.student.index', [
      'students' => $students,
    ]);
  }

  public function fetchStudents()
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
    return view('admin.student.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StudentInformationRequest $request)
  {
    // $student = StudentInformation::create($request->all());
    // return response()->json([
    //   'insertedId' => $student->id,
    //   'message' => 'Successfully saved student information',
    //   'status' => 200
    // ]);

    $avatar = $request->image;
    $avatar_name = time() . $avatar->getClientOriginalName();
    $avatar->move('images/avatar', $avatar_name);

    StudentInformation::create([
      'id_num' => $request->id_num,
      'image' => 'images/avatar/' . $avatar_name,
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
      'status' => true,
    ]);

    return redirect()->back()->with('message', 'Student Record for ID# ' . $request->id_num . ' ' . $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name . ' was successfully saved.');
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
    $eduBackgrounds = EducationBackground::where('student_id', $id)->orderBy('created_at', 'Desc')->get();
    $enrollments = Enrollment::where('student_id', $id)->orderBy('created_at', 'Desc')->get();
    // $classSchedules = ClassSchedule::where('student_id', $id)->get();

    return view('admin.student.edit', [
      'student' => $student,
      'eduBackgrounds' => $eduBackgrounds,
      'enrollments' => $enrollments,
      // 'classSchedules' => $classSchedules,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\StudentInformation  $student
   * @return \Illuminate\Http\Response
   */
  // public function update(Request $request, StudentInformation $student)
  public function update(StudentInformationRequest $request, $id)
  {
    // $student->update($request->all());

    // return response()->json([
    //   'update' => new StudentInformationResource($student),
    //   'message' => 'Student Information was updated successfully!',
    //   'status' => 200
    // ]);

    $student = StudentInformation::findOrFail($id);

    if ($request->hasFile('image')) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $avatar = $request->image;
        $avatar_name = time() . $avatar->getClientOriginalName();
        $avatar->move('images/avatar', $avatar_name);
        $student->image = 'images/avatar/' . $avatar_name;
    }

    $student->id_num = $request->id_num;
    $student->first_name = $request->first_name;
    $student->middle_name = $request->middle_name;
    $student->last_name = $request->last_name;
    $student->gender = $request->gender;
    $student->birth_date = $request->birth_date;
    $student->phone_number = $request->phone_number;
    $student->address = $request->address;
    $student->emcon_full_name = $request->emcon_full_name;
    $student->emcon_phone_number = $request->emcon_phone_number;
    $student->emcon_relationship = $request->emcon_relationship;
    $student->emcon_address = $request->emcon_address;
    $student->save();

    return redirect()->back()->with('message', 'Student Record for ID# ' . $request->id_num . ' ' . $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name . ' was successfully updated.');
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
