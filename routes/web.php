<?php

Route::get('/', function () {
  return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
  
  Route::prefix('educationalbackground')->group(function() {
    Route::post('/store', 'EducationBackgroundController@store');
    Route::post('/update/{id}', 'EducationBackgroundController@update');
  });
  
  Route::prefix('subject')->group(function () {
    Route::resource('/', 'SubjectController');
    Route::post('/update/{id}', 'SubjectController@update');
    Route::post('/store', 'SubjectController@store');
  });

  Route::prefix('student-level')->group(function () {
    Route::resource('/', 'StudentLevelController');
    Route::post('/update/{id}', 'StudentLevelController@update');
    Route::post('/store', 'StudentLevelController@store');
  });

  Route::prefix('classroom')->group(function () {
    Route::resource('/', 'ClassroomController');
    Route::post('/update/{id}', 'ClassroomController@update');
    Route::post('/store', 'ClassroomController@store');
  });

  Route::prefix('class-rate')->group(function () {
    Route::resource('/', 'ClassRateController');
    Route::post('/update/{id}', 'ClassRateController@update');
    Route::post('/store', 'ClassRateController@store');
  });

  Route::prefix('user')->group(function () {
    Route::resource('/', 'UserController');
    Route::post('/update/{id}', 'UserController@update');
    Route::post('/store', 'UserController@store');
  });

  Route::prefix('studentmanagement')->group(function () {
    Route::get('/', 'StudentInformationController@index');
    Route::get('/edit/{id}', 'StudentInformationController@edit');
    Route::post('/update/{id}', 'StudentInformationController@update');
    Route::post('/store', 'StudentInformationController@store');
  });

  Route::prefix('instructor')->group(function () {
    Route::get('/', 'InstructorController@index');
    Route::post('/store', 'InstructorController@store');
    Route::get('/edit/{id}', 'InstructorController@edit');
    Route::post('/update/{id}', 'InstructorController@update');
  });

  Route::prefix('classschedule')->group(function () {
    Route::get('/', 'ClassScheduleController@index');

    Route::get('/getStudentByClass/{id}', 'ClassScheduleController@getStudentByClass');
    Route::post('/store', 'ClassScheduleController@store');
    Route::post('/update/{id}', 'ClassScheduleController@update');
    Route::get('/delete/{id}', 'ClassScheduleController@destroy');
  });

  Route::prefix('studentaccount')->group(function () {
    Route::get('/', 'StudentAccountController@index');
    Route::get('/edit/{paytype}/{id}', 'StudentAccountController@edit');
    Route::post('/store', 'StudentAccountController@store');
    Route::post('/update/{id}', 'StudentAccountController@update');
    Route::post('/delete/{id}', 'StudentAccountController@destroy');
    Route::get('/filterdate/{paytype}/{id}/{year}/{month}', 'StudentAccountController@filterDate');
  });

  Route::get('/configuration', 'ConfigurationController@index');
  // Route::get('/revenue-test', 'DashboardController@getRevenues');
  Route::get('/', 'DashboardController@index')->name('dashboard');

});
