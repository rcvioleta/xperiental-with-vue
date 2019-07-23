<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\StudentInformation;
use App\StudentAccount;
use App\ClassStudent;
// use App\ClassSchedule;

class StudentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getAllStudentAccount();

        return view('admin.student-account.index', [
          'data' => $data,
        ]);
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
        StudentAccount::create($request->all());

        return response()->json([
          'message' => 'Successfully added New Payment Record',
          'newlist' => $this->getStudentAccount($request->student_id),
          'accountInfo' => $this->getAccountInfo($request->student_id),
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
        $student = StudentInformation::where('id', $id)->first();

        $classSchedules = $this->getStudentClassSchedule($id);

        $accounts = $this->getStudentAccount($id);

        $accountInfo = $this->getAccountInfo($id);

        return view('admin.student-account.edit', [
          'student' => $student,
          'classSchedules' => $classSchedules,
          'accounts' => $accounts,
          'accountInfo' => $accountInfo,
          'currentYear' => Carbon::today()->format('Y')
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
        $studentAccount = StudentAccount::findOrFail($id);

        $studentAccount->update($request->all());

        return response()->json([
          'message' => 'Successfully updated Payment Record',
          'newlist' => $this->getStudentAccount($request->student_id),
          'accountInfo' => $this->getAccountInfo($request->student_id),
          'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $student_id)
    {
        StudentAccount::destroy($id);

        return response()->json([
          'message' => 'Successfully deleted Payment Schedule',
          'newlist' => $this->getStudentAccount($student_id),
          'accountInfo' => $this->getStudentAccount($student_id),
          'status' => 200
        ]);
    }   

    protected function getAllStudentAccount() {

        $accounts = StudentInformation::groupBy('student_information.id')
                    ->leftJoin('class_students', 'class_students.student_id', 'student_information.id')
                    ->leftJoin('class_schedules', 'class_students.class_schedules_id', 'class_schedules.id')
                    ->selectRaw('student_information.id as student_id, id_num, nickname, first_name, middle_name, last_name, sum(credit_cost) as credit_cost')
                    ->orderBy('id_num')
                    ->get();

        $payment = StudentAccount::groupBy('student_id')
                    ->selectRaw('student_id, sum(amount) as payment')
                    ->where('payment_type', '1')->get();

        $annual_fee = StudentAccount::groupBy('student_id')
                    ->selectRaw('student_id, COUNT(*) as annual_fee')
                    ->where('payment_type', '0')
                    ->whereYear('payment_date', Carbon::today()->format('Y'))
                    ->get();

        return [
                'accounts' => $accounts,
                'payment' => $payment,
                'annual_fee' => $annual_fee
            ];
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

    protected function getStudentAccount($id) {
        return StudentAccount::where('student_id', $id)
            ->orderBy('payment_date', 'desc')
            ->get();
    }

    protected function getAccountInfo($id) {

        $first_payment = StudentAccount::select('payment_date')->where('student_id', $id)->orderBy('payment_date', 'asc')->first();
        $last_payment = StudentAccount::select('payment_date')->where('student_id', $id)->orderBy('payment_date', 'desc')->first();
        $payment_count = StudentAccount::where('student_id', $id)->count();
        $payment_count = StudentAccount::where('student_id', $id)->count();
        $total_payment = StudentAccount::where('student_id', $id)->where('payment_type', '1')->sum('amount');
        $used_credits = ClassStudent::where('student_id', $id)->sum('credits');
        $credit_cost = ClassStudent::leftJoin('class_schedules', 'class_students.class_schedules_id', 'class_schedules.id')
            ->where('student_id', $id)->sum('credit_cost');
        $annual_fee = StudentAccount::where('student_id', $id)->where('payment_type', '0')
            ->whereYear('payment_date', Carbon::today()->format('Y'))->count();

        if($first_payment == null)
            $first_payment['payment_date'] = 'No Record';

        if($last_payment == null)
            $last_payment['payment_date'] = 'No Record';

        return $accountInfo = [
            'first_payment' => $first_payment,
            'last_payment' => $last_payment,
            'payment_count' => $payment_count,
            'total_payment' => $total_payment,
            'used_credits' => $used_credits,
            'annual_fee' => $annual_fee,
            'credit_cost' => $credit_cost
        ];
    }
}
