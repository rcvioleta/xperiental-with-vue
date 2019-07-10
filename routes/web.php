<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
  Route::resource('/student', 'StudentInformationController');

  Route::group(['prefix' => 'get'], function () {
    Route::get('/students', 'StudentInformationController@fetchStudents');
  });

  Route::resource('/emergency-contact', 'EmergencyContactController');
  Route::resource('/education-background', 'EducationBackgroundController');

  Route::resource('/subject', 'SubjectController');
  Route::get('/subject/active/{slug}', 'SubjectController@active');
  Route::get('/subject/inactive/{slug}', 'SubjectController@inactive');

  Route::resource('/student-level', 'StudentLevelController');
  Route::get('/student-level/active/{slug}', 'StudentLevelController@active');
  Route::get('/student-level/inactive/{slug}', 'StudentLevelController@inactive');

  Route::resource('/classroom', 'ClassroomController');
  Route::get('/classroom/active/{slug}', 'ClassroomController@active');
  Route::get('/classroom/inactive/{slug}', 'ClassroomController@inactive');

  Route::resource('/class-rate', 'ClassRateController');
  Route::get('/class-rate/active/{slug}', 'ClassRateController@active');
  Route::get('/class-rate/inactive/{slug}', 'ClassRateController@inactive');

  Route::resource('/user', 'UserController');
  Route::get('/user/active/{slug}', 'UserController@active');
  Route::get('/user/inactive/{slug}', 'UserController@inactive');

  Route::resource('/schedule', 'ClassScheduleController');

  /* routes that are responsible for routing */
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::get('/configurations', 'DashboardController@configurations')->name('configurations');
  Route::get('/add-student', 'DashboardController@addStudent')->name('add-student');
  Route::get('/students', 'DashboardController@showStudentList')->name('student-list');
  Route::get('/class-schedule', 'DashboardController@scheduleIndex')->name('class-schedule');


  // Start Jomar
  Route::prefix('enrollment')->group(function () {
    Route::get('/', 'EnrollmentController@index')->name('enrollment.index');
    Route::get('/create', 'EnrollmentController@create')->name('enrollment.create');
    Route::get('/{id}/edit/', 'EnrollmentController@edit')->name('enrollment.edit');
    Route::post('/{id}/update', 'EnrollmentController@update')->name('enrollment.update');
    Route::post('/', 'EnrollmentController@store')->name('enrollment.store');
    Route::post('/{id}', 'EnrollmentController@update')->name('enrollment.update');
  });

  Route::prefix('studentmanagement')->group(function () {
    Route::get('/', 'StudentInformationController@index')->name('student.index');
    Route::get('/create', 'StudentInformationController@create')->name('student.create');
    Route::get('/{id}/edit/', 'StudentInformationController@edit')->name('student.edit');
    Route::post('/{id}/update', 'StudentInformationController@update')->name('student.update');
    Route::post('/', 'StudentInformationController@store')->name('student.store');
    Route::post('/{id}', 'StudentInformationController@update')->name('student.update');
  });

  Route::prefix('instructor')->group(function () {
    Route::get('/', 'InstructorController@index')->name('instructor.index');
    Route::get('/create', 'InstructorController@create')->name('instructor.create');
    Route::post('/store', 'InstructorController@store')->name('instructor.store');
    Route::get('/{id}/edit', 'InstructorController@edit')->name('instructor.edit');
    Route::post('/{id}/update', 'InstructorController@update')->name('instructor.update');
    Route::get('/{id}', 'InstructorController@destroy')->name('instructor.destroy');
    Route::get('/{id}/activate', 'InstructorController@activate')->name('instructor.activate');
    Route::get('/{id}/deactivate', 'InstructorController@deactivate')->name('instructor.deactivate');
  });

  Route::prefix('classschedule')->group(function () {
    Route::get('/', 'ClassScheduleController@index')->name('classschedule.index');

    Route::get('/getStudentByClass/{id}', 'ClassScheduleController@getStudentByClass');
    Route::post('/store', 'ClassScheduleController@store');
    Route::post('/update/{id}', 'ClassScheduleController@update');
    Route::get('/delete/{id}', 'ClassScheduleController@destroy');
  });

  Route::get('/revenue-test', 'DashboardController@getRevenues');
});
