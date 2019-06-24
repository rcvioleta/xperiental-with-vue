<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentInformation;
use App\EducationBackground;
use App\Enrollment;
use App\ClassSchedule;
use App\ClassStudent;
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

    return view('admin.student.index', [
      'students' => $students,
    ]);
  }

  public function fetchStudents()
  {
    $students = StudentInformation::all();
    return StudentInformationResource::collection($students);
  }

  protected function getStudentClassSchedule($id) {
    return ClassStudent::join('class_schedules', 'class_students.class_schedules_id', 'class_schedules.id')
      ->join('class_rates', 'class_rates.id', 'class_schedules.class_rate_id')
      ->join('subjects', 'subjects.id', 'class_schedules.subject_id')
      ->join('instructors', 'instructors.id', 'class_schedules.instructor_id')
      ->select('class_schedules.*', 'credits', 'class_rates.name as class_type', 'subjects.name as subject', 'first_name', 'middle_name', 'last_name', 'class_schedules.status as status')
      ->where('student_id', $id)
      ->orderBy('class_students.class_students_id', 'Desc')
      ->get();
  }

  protected function getStudentEnrollment($id) {
    return Enrollment::join('class_rates', 'class_rates.id', 'enrollments.credit_type_id')
        ->select('enrollments.*', 'class_rates.name as credit_name')
        ->where('student_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();
  }

  protected function getStudentBackgroundEdu($id) {
    return EducationBackground::where('student_id', $id)->orderBy('created_at', 'Desc')->get();
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

    $eduBackgrounds = $this->getStudentBackgroundEdu($id);

    $enrollments = $this->getStudentEnrollment($id);

    $classSchedules = $this->getStudentClassSchedule($id);


    return view('admin.student.edit', [
      'student' => $student,
      'eduBackgrounds' => $eduBackgrounds,
      'enrollments' => $enrollments,
      'classSchedules' => $classSchedules,
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
