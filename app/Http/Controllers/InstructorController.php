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
        return view('admin.instructor.index')->with('instructors', Instructor::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructorRequest $request)
    {
        $avatar = $request->image;
        $avatar_name = time() . $avatar->getClientOriginalName();
        $avatar->move('images/avatar', $avatar_name);

        $newInstructor = [
            'id_num' => $request->id_num,
            'image' => 'images/avatar/' . $avatar_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'gender' => $request->gender,
            'bday' => $request->bday,
            'contact_num' => $request->contact_num,
            'address' => $request->address,
            'hired_date' => $request->hired_date,
            'status' => $request->status
        ];

        Instructor::create($newInstructor);
        return redirect()->route('instructor.index');
    }

    public function activate($id)
    {
        $instructor = Instructor::find($id);
        $instructor->status = 1;
        $instructor->save();
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $instructor = Instructor::find($id);
        $instructor->status = 0;
        $instructor->save();
        return redirect()->back();
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
        return view('admin.instructor.edit')->with('instructor', Instructor::find($id));
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

        $instructor = Instructor::find($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $avatar = $request->image;
            $avatar_name = time() . $avatar->getClientOriginalName();
            $avatar->move('images/avatar', $avatar_name);
            $instructor->image = 'images/avatar/' . $avatar_name;
        }

        $instructor->id_num = $request->id_num;
        $instructor->first_name = $request->first_name;
        $instructor->middle_name = $request->middle_name;
        $instructor->last_name = $request->last_name;
        $instructor->position = $request->position;
        $instructor->gender = $request->gender;
        $instructor->bday = $request->bday;
        $instructor->contact_num = $request->contact_num;
        $instructor->address = $request->address;
        $instructor->hired_date = $request->hired_date;
        $instructor->status = $request->status;
        $instructor->save();

        return redirect()->route('instructor.index');
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
