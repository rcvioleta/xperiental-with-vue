<?php

namespace App\Http\Controllers;

use App\EducationBackground;
use Illuminate\Http\Request;

class EducationBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $educationBackground = EducationBackground::create($request->all());
        return response()->json([
            'insertedId' => $educationBackground->id,
            'message' => 'Successfully saved education background',
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EducationBackground  $educationBackground
     * @return \Illuminate\Http\Response
     */
    public function show(EducationBackground $educationBackground)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EducationBackground  $educationBackground
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationBackground $educationBackground)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EducationBackground  $educationBackground
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationBackground $educationBackground)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EducationBackground  $educationBackground
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationBackground $educationBackground)
    {
        //
    }
}
