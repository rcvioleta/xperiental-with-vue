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
  Route::resource('/subject', 'SubjectController');
  Route::get('/subject/active/{slug}', 'SubjectController@active');
  Route::get('/subject/inactive/{slug}', 'SubjectController@inactive');

  Route::resource('/student', 'StudentInformationController');

  Route::resource('/emergency-contact', 'EmergencyContactController');

  Route::resource('/education-background', 'EducationBackgroundController');

  Route::resource('/student-level', 'StudentLevelController');

  Route::resource('/classroom', 'ClassroomController');

  Route::resource('/class-rate', 'ClassRateController');

  Route::resource('/user', 'UserController');
  Route::get('/user/active/{slug}', 'UserController@active');
  Route::get('/user/inactive/{slug}', 'UserController@inactive');

  /* routes that are responsible for routing */
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/configurations', 'HomeController@configurations')->name('configurations');
  Route::get('/add-student', 'HomeController@addStudent')->name('add-student');
  Route::get('/students', 'HomeController@showStudentList')->name('student-list');
});
