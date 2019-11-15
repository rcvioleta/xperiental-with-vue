<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\StudentInformation;
use App\StudentAccount;
use App\Instructor;
use App\ClassSchedule;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.app');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $month = Carbon::now()->format('m');
        $monthword = Carbon::now()->format('F');

        $studentcount = StudentInformation::where('status', '1')->count();
        $instructorcount = Instructor::where('status', '1')->count();
        $schedulecount = ClassSchedule::whereMonth('date_start', $month)->count();

        $subjects = ClassSchedule::selectRaw('name, count(credit_cost) as total')
            ->rightJoin('subjects', 'subjects.id', 'class_schedules.subject_id')
            ->whereMonth('date_start', $month)
            ->groupBy('name')
            ->get();

        $cost = ClassSchedule::sum('credit_cost');
        $paid = StudentAccount::sum('amount');
        $balance = ($cost - $paid);

        if($cost < $paid)
            $balance = 0;
            

        return response()->json([
            'currentmonth' => $monthword,
            'studentcount' => $studentcount,
            'instructorcount' => $instructorcount,
            'schedulecount' => $schedulecount,
            'subjects' => $subjects,
            'balance' => $balance,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
