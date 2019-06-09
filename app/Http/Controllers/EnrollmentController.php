<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enrollment;
use App\StudentInformation;
use App\ClassRate;

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

    protected function getStudents() {
        return StudentInformation::get();
    }

    protected function getClassTypes() {
        return ClassRate::get();
    }

    protected function getEnrollments() {
        return Enrollment::join('student_information', 'enrollments.student_id', '=', 'student_information.id')
            ->join('class_rates', 'enrollments.credit_type_id', '=', 'class_rates.id')
            ->select('enrollments.*', 'first_name', 'last_name', 'name as credit_type')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class_rate = ClassRate::where('id', '=', $request->get('class_type'))->value('rate');

        // echo "hey"; die;

        Enrollment::create([
            'student_id' => $request->get('student_name_id'),
            'credits' => $request->get('credits'),
            'credit_type_id' => $request->get('class_type'),
            'payment_status' => $request->get('payment_status'),
            'remarks' => $request->get('remarks'),
            'amount_paid' => $request->get('amount_paid'),
            'amount_balance' => ($class_rate * $request->get('credits')) - $request->get('amount_paid'),
            'status' => true
        ]);

        return redirect()->back()->with('message', 'New Enrollment Record for student ID #'.$request->get('student_name_id').' was successfully saved.');
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

        $class_rate = ClassRate::where('id', '=', $request->get('class_type'))->value('rate');

		$enrollment = Enrollment::findOrFail($id);

        $enrollment->fill([
            'credits' => $request->get('credits'),
            'credit_type_id' => $request->get('class_type'),
            'payment_status' => $request->get('payment_status'),
            'remarks' => $request->get('remarks'),
            'amount_paid' => $request->get('amount_paid'),
            'amount_balance' => ($class_rate * $request->get('credits')) - $request->get('amount_paid'),
        ])->push();

		return redirect()->back()->with('message', 'Enrollment Record for student ID #'.$enrollment->student_id.' was successfully updated.');
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
