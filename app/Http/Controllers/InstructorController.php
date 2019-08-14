<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use App\Http\Requests\InstructorRequest;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Instructor::orderBy('id_num')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructorRequest $request)
    {
        if($request->image != "" && $request->image != null) {

            $avatar = $request->image;
            $avatar_name = time() . $avatar->getClientOriginalName();

            $avatar->move('images/avatar/employee', $avatar_name);
            $avatar_name = 'images/avatar/employee/'.$avatar_name;
        }
        else {
            $avatar_name = 'images/avatar/employee/avatar-default.png';  
        }

        $employee = Instructor::create([
          'image' => $avatar_name,
          'id_num' => $request->id_num,
          'nickname' => $request->nickname,
          'first_name' => $request->first_name,
          'middle_name' => $request->middle_name,
          'last_name' => $request->last_name,
          'gender' => $request->gender,
          'bday' => $request->bday,
          'contact_num' => $request->contact_num,
          'address' => $request->address,
          'position' => $request->position,
          'hired_date' => $request->hired_date,
          'status' => $request->status
        ]);

        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Instructor::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstructorRequest $request, $id)
    {
        $employee = Instructor::findOrFail($id);

        if($request->hasFile('image')) {
            $avatar = $request->image;
            $avatar_name = time() . $avatar->getClientOriginalName();

            $avatar->move('images/avatar/employee', $avatar_name);
            $avatar_name = 'images/avatar/employee/'.$avatar_name;
        }
        else {
            $avatar_name = $request->image;  
        }

        $employee->update([
          'image' => $avatar_name,
          'id_num' => $request->id_num,
          'nickname' => $request->nickname,
          'first_name' => $request->first_name,
          'middle_name' => $request->middle_name,
          'last_name' => $request->last_name,
          'gender' => $request->gender,
          'bday' => $request->bday,
          'contact_num' => $request->contact_num,
          'address' => $request->address,
          'position' => $request->position,
          'hired_date' => $request->hired_date,
          'status' => $request->status
        ]);

        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instructor = Instructor::find($id);
        $instructor->delete();
        return redirect()->back();
    }
}
