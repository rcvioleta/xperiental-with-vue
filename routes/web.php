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

  /* routes that are responsible for routing */
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/class-calendar', 'HomeController@classCalendar')->name('class-calendar');
  Route::get('/configurations', 'HomeController@configurations')->name('configurations');
  Route::get('/add-student', 'HomeController@addStudent')->name('add-student');
  Route::get('/students', 'HomeController@showStudentList')->name('student-list');
});
