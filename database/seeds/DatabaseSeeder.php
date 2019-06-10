<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Subject;
use App\StudentLevel;
use App\Classroom;
use App\ClassRate;
use App\EducationBackground;
use App\StudentInformation;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // $this->call(UsersTableSeeder::class);
    factory(User::class, 5)->create();

    $subjects = ['English', 'Filipino', 'Mathematics', 'Science and Health', 'Makabayan', 'Sibika at Kultura', 'MSEP'];
    foreach ($subjects as $subject) {
      Subject::create([
        'name' => $subject,
        'slug' => str_slug($subject),
        'status' => 1
      ]);
    }

    $studentLevels = ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'];
    foreach ($studentLevels as $studentLevel) {
      StudentLevel::create([
        'name' => $studentLevel,
        'slug' => str_slug($studentLevel),
        'status' => 1
      ]);
    }

    $classrooms = ['Classroom 1', 'Classroom 2', 'Classroom 3', 'Classroom 4', 'Classroom 5'];
    foreach ($classrooms as $classroom) {
      Classroom::create([
        'name' => $classroom,
        'slug' => str_slug($classroom),
        'status' => 1
      ]);
    }

    $classRates = ['regular' => 400, 'special' => 800];
    foreach ($classRates as $classRateKey => $classRateVal) {
      ClassRate::create([
        'name' => $classRateKey,
        'slug' => str_slug(strval($classRateKey)),
        'rate' => $classRateVal,
        'status' => 1
      ]);
    }

    // $edu_background = [
    //   ['name' => 'Stella Maris Academy', 'attended' => '2008-2013', 'notes' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
    //   ['name' => 'University of the Immaculate Conception', 'attended' => '2014-2017', 'notes' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.']
    // ];
    // foreach ($edu_background as $index => $row) {
    //   EducationBackground::create([
    //     'name' => $row['name'],
    //     'slug' => str_slug($row['name']),
    //     'year_attended' => $row['attended'],
    //     'notes' => $row['notes']
    //   ]);
    // }

    factory(StudentInformation::class, 20)->create();
  }
}
