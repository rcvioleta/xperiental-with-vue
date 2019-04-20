<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
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
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min: 8 | confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::create($request->all());

        $update = ['name' => $user->name, 'slug' => $user->slug, 'email' => $user->email, 'status' => $user->status];

        return response()->json([
            'update' => $update,
            'message' => 'User added successfully!',
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

    public function active($slug)
    {
        $user = User::where('slug', '=', $slug)->first();
        $user->status = 1;
        $user->save();
        return response('Updated status to active', 200);
    }

    public function inactive($slug)
    {
        $user = User::where('slug', '=', $slug)->first();
        $user->status = 0;
        $user->save();
        return response('Updated status to inactive', 200);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min: 8 | confirmed',
            'password_confirmation' => 'required'
        ]);

        $user->update($request->all());
        $update = ['name' => $user->name, 'slug' => $user->slug, 'email' => $user->email, 'status' => $user->status];
        return response()->json([
            'update' => $update,
            'message' => 'User was updated successfully!',
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'slug' => $user->slug,
            'message' => 'User was deleted successfully!',
            'status' => 204
        ]);
    }
}
