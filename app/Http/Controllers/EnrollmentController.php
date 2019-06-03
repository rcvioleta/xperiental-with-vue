<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enrollment;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.enrollment.index')->with([
        	'enrollments' => (new Enrollment())->newQuery()
        	->join('student_information', 'enrollments.student_id', '=', 'student_information.id')
            ->join('class_rates', 'enrollments.credit_type_id', '=', 'class_rates.id')
            ->select('enrollments.*', 'first_name', 'last_name', 'name as credit_type')
            ->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.enrollment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  //       $this->validate($request, [
		// 	'name' => 'required|unique:categories,name'
		// ]);
		// $path = asset('assets/images/default-img.png');
		// if ($request->hasFile('image')) {
		// 	$path = $request->file('image')->store('categories');
		// }
		// $data = ['name' => $request->name, 'path' => $path];
		// (new Category())->newQuery()->create($data);
		// $request->session()->flash('message', "Successfully create category.");
		// return redirect()->back();
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
        return view('admin.enrollment.edit')->with([
			'enrollment' => (new Enrollment())->newQuery()->where('enrollment_id', $id)->first()
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
  //       $this->validate($request, ['name' => "required|unique:categories,name,{$category->id}"]);
		// $path = $category->path;
		// if ($request->hasFile('image')) {
		// 	$path = $request->file('image')->store('categories');
		// }
		// $data = ['name' => $request->name, 'path' => $path];
		// $category->fill($data)->save();
		// $request->session()->flash('message', "Successfully update category");
		// return redirect()->back();
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
