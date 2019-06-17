<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::resource('/instructor', 'InstructorController');

// Educational background API's
Route::prefix('educationalbackground')->group(function() {
	Route::post('/store', 'EducationBackgroundController@store');
	Route::post('/update/{id}', 'EducationBackgroundController@update');
});
Route::prefix('classschedule')->group(function() {
	Route::post('/store', 'ClassScheduleController@store');
	Route::post('/update/{id}', 'ClassScheduleController@update');
});
