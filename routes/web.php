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
  return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
  Route::resource('/subject', 'SubjectController');

  Route::resource('/student', 'StudentInformationController');

  Route::resource('/emergency-contact', 'EmergencyContactController');

  Route::resource('/education-background', 'EducationBackgroundController');

  /* routes that are responsible for routing */
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/configurations', 'HomeController@configurations')->name('configurations');
  Route::get('/add-student', 'HomeController@addStudent')->name('add-student');
  Route::get('/students', 'HomeController@showStudentList')->name('student-list');
});
