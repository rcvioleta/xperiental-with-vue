<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enrollment;
use App\StudentInformation;
use App\ClassRate;
use App\Http\Requests\EnrollmentRequest;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.enrollment.index', [
            'enrollments' => $this->getEnrollments(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = $this->getStudents();
        $classtypes = $this->getClassTypes();

        return view('admin.enrollment.create', [
            'students' => $students,
            'classtypes' => $classtypes
        ]);
    }

    protected function getStudents()
    {
        return StudentInformation::get();
    }

    protected function getClassTypes()
    {
        return ClassRate::get();
    }

    protected function getEnrollments()
    {
        return Enrollment::join('student_information', 'enrollments.student_id', '=', 'student_information.id')
            ->join('class_rates', 'enrollments.credit_type_id', '=', 'class_rates.id')
            ->select('enrollments.*', 'first_name', 'last_name', 'id_num', 'name as credit_type')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnrollmentRequest $request)
    {
        $class_rate = ClassRate::where('id', '=', $request->class_type)->value('rate');

        // echo "hey"; die;

        Enrollment::create([
            'student_id' => $request->student_name_id,
            'credits' => $request->credits,
            'credit_type_id' => $request->class_type,
            'payment_status' => $request->payment_status,
            'remarks' => $request->remarks,
            'amount_paid' => $request->amount_paid,
            'amount_balance' => ($class_rate * $request->credits) - $request->amount_paid,
            'status' => true
        ]);

        return redirect()->back()->with('message', 'New Enrollment Record was successfully saved.');
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
        $enrollment = Enrollment::join('student_information', 'enrollments.student_id', '=', 'student_information.id')
            ->join('class_rates', 'enrollments.credit_type_id', '=', 'class_rates.id')
            ->select('enrollments.*', 'first_name', 'last_name', 'name as credit_type')
            ->where('enrollment_id', $id)
            ->first();

        $classtypes = $this->getClassTypes();

        return view('admin.enrollment.edit', [
            'enrollment' => $enrollment,
            'classtypes' => $classtypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => "required"
        // ]);

        $class_rate = ClassRate::where('id', '=', $request->class_type)->value('rate');

        $enrollment = Enrollment::findOrFail($id);

        $enrollment->fill([
            'credits' => $request->credits,
            'credit_type_id' => $request->class_type,
            'payment_status' => $request->payment_status,
            'remarks' => $request->remarks,
            'amount_paid' => $request->amount_paid,
            'amount_balance' => ($class_rate * $request->credits) - $request->amount_paid,
        ])->push();

        return redirect()->back()->with('message', 'Enrollment Record for student ID #' . $enrollment->student_id . ' was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
