<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
// use App\Enrollment;
use App\Subject;
use App\Instructor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    // $enrolled_students = Enrollment::where('status', 1)->get();
    // $credits = Enrollment::where('credits', '>', 0)->sum('credits');
    $subjects = Subject::where('status', 1)->get();
    $instructors = Instructor::where('status', 1)->get();
    
    return view('dashboard', [
      'users' => User::all(),
      // 'enrolled_students' => count($enrolled_students),
      'total_instructors' => count($instructors),
      // 'unused_credits' => $credits,
      'total_subjects' => count($subjects),
      // 'total_revenue' => $this->getRevenues()
    ]);
  }

  public function getRevenues() 
  {
    // $raw_data_revenue = Enrollment::get();
    // $total_revenue = [];
  
    // foreach ($raw_data_revenue as $revenue) {
    //   if ($revenue['payment_status'] === 'Fully Paid') {
    //     preg_match('/[0-9]{4}/', $revenue['enrolled_date'], $rev_date);
    //     $data_exist = in_array($rev_date[0], array_column($total_revenue, 'enrolled_date'));
        
    //     if ($data_exist) {
    //         $key = array_search($rev_date[0], array_column($total_revenue, 'enrolled_date'));
    //         $total_revenue[$key]['revenue'] += $revenue['amount_paid'];
    //     } else {
    //       $total_revenue[] = [
    //         'enrolled_date' => $rev_date[0],
    //         'revenue' => intval($revenue['amount_paid'])
    //       ];
    //     }
    //   }

    // }
    
    // return response($total_revenue, 200);
    // return json_encode($total_revenue);
  }

  public function configurations()
  {
    return view('admin.configurations');
  }

  public function addStudent()
  {
    return view('admin.add-student');
  }

  public function showStudentList()
  {
    return view('admin.student-list');
  }

  public function scheduleIndex()
  {
    return view('admin.class-calendar');
  }
}
