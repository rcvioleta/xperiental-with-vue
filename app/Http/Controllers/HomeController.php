<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
  public function __construct()
  {
    // $this->middleware('auth');
  }

  /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  public function index()
  {
    return view('home');
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
}
