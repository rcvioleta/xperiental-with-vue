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
        return $this->getAllStudentAccount();
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
        $filter_year = $request->filter_year;
        $filter_month = $request->filter_month;
        $request->request->remove('filter_year');
        $request->request->remove('filter_month');

        StudentAccount::create($request->all());

        return response()->json([
          'message' => 'Successfully added New Payment Record',
          'newlist' => $this->getStudentAccount($request->student_id, $request->payment_type, $filter_year, $filter_month),
          'accountInfo' => $this->getAccountInfo($request->student_id, $filter_year, $filter_month),
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
    public function edit($paytype, $id)
    {
        $student = StudentInformation::where('id', $id)->first();

        $classSchedules = $this->getStudentClassSchedule($id);

        $accountInfo = $this->getAccountInfo($id, Carbon::today()->format('Y'), Carbon::today()->format('m'));

        $data = [
          'student' => $student,
          'classSchedules' => $classSchedules,
          'accounts' => $this->getStudentAccount($id, $paytype, Carbon::today()->format('Y'), Carbon::today()->format('m')),
          'accountInfo' => $accountInfo,
          'currentYear' => Carbon::today()->format('Y')
        ];

        return $data;
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
        $filter_year = $request->filter_year;
        $filter_month = $request->filter_month;
        $request->request->remove('filter_year');
        $request->request->remove('filter_month');

        $studentAccount = StudentAccount::findOrFail($id);

        $studentAccount->update($request->all());

        return response()->json([
          'message' => 'Successfully updated Payment Record',
          'newlist' => $this->getStudentAccount($request->student_id, $request->payment_type, $filter_year, $filter_month),
          'accountInfo' => $this->getAccountInfo($request->student_id, $filter_year, $filter_month),
          'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        StudentAccount::destroy($id);

        return response()->json([
          'message' => 'Successfully deleted Payment Schedule',
          'newlist' => $this->getStudentAccount($request->student_id, $request->payment_type, $request->filter_year, $request->filter_month),
          'accountInfo' => $this->getAccountInfo($request->student_id, $request->filter_year, $request->filter_month),
          'status' => 200
        ]);
    }   

    protected function getAllStudentAccount() {

        $accounts = StudentInformation::groupBy('student_information.id')
                    ->leftJoin('class_students', 'class_students.student_id', 'student_information.id')
                    ->leftJoin('class_schedules', 'class_students.class_schedules_id', 'class_schedules.id')
                    ->selectRaw('student_information.id as student_id, id_num, nickname, first_name, middle_name, last_name, sum(credit_cost) as credit_cost')
                    // ->where('student_information.status', '1')
                    ->whereMonth('class_schedules.created_at', Carbon::today()->format('m'))
                    ->orderBy('id_num')
                    ->get();

        $payment = StudentAccount::groupBy('student_id')
                    ->selectRaw('student_id, sum(amount) as payment')
                    ->where('payment_type', '1')
                    ->get();

        // $annual_fee = StudentAccount::groupBy('student_id')
        //             ->selectRaw('student_id, COUNT(*) as annual_fee')
        //             ->where('payment_type', '0')
        //             ->whereYear('payment_date', Carbon::today()->format('Y'))
        //             ->get();

        $annual_fee = StudentAccount::groupBy('student_id')
                    ->selectRaw('student_id, PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM NOW()), EXTRACT(YEAR_MONTH FROM payment_date)) as annual_fee')
                    ->where('payment_type', '0')
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

    protected function getStudentAccount($id, $payType, $year, $month) {
        return StudentAccount::where('student_id', $id)
            ->where('payment_type', $payType)
            ->whereYear('payment_date', $year)
            ->whereMonth('payment_date', $month)
            ->orderBy('payment_date', 'desc')
            ->get();
    }

    protected function getAccountInfo($id, $year, $month) {
 
        $last_payment = StudentAccount::select('payment_date')
                    ->where('student_id', $id)
                    ->where('payment_type', '1')
                    ->orderBy('payment_date', 'desc')
                    ->first();
        $total_payment = StudentAccount::where('student_id', $id)
                    ->whereYear('payment_date', $year)
                    ->whereMonth('payment_date', $month)
                    ->where('payment_type', '1')
                    ->sum('amount');
        $used_credits = ClassStudent::leftJoin('class_schedules', 'class_students.class_schedules_id', 'class_schedules.id')
                    ->where('student_id', $id)
                    ->whereYear('date_start', $year)
                    ->whereMonth('date_start', $month)
                    ->sum('credits');
        $credit_cost = ClassStudent::leftJoin('class_schedules', 'class_students.class_schedules_id', 'class_schedules.id')
                    ->where('student_id', $id)
                    ->whereYear('date_start', $year)
                    ->whereMonth('date_start', $month)
                    ->sum('credit_cost');

        if($last_payment == null)
            $last_payment = 'No Record';
        else
            $last_payment = $last_payment->payment_date;
            

        return $accountInfo = [
            'last_payment' => $last_payment,
            'total_payment' => $total_payment,
            'used_credits' => $used_credits,
            'credit_cost' => $credit_cost
        ];
    }

    protected function filterDate($paytype, $id, $year, $month)
    {
        $student = StudentInformation::where('id', $id)->first();

        $classSchedules = $this->getStudentClassSchedule($id);

        $accountInfo = $this->getAccountInfo($id, $year, $month);

        $data = [
          'student' => $student,
          'classSchedules' => $classSchedules,
          'accounts' => $this->getStudentAccount($id, $paytype, $year, $month),
          'accountInfo' => $accountInfo,
          'currentYear' => Carbon::today()->format('Y')
        ];

        return $data;
    }

}
