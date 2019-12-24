<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Marks;
use App\GradeSetting;

class ResultController extends Controller
{

  public function students()
  {
    return Student::select('id', 'roll_no', 'name', 'father_name', 'gender')->get();
  }


  public function result(Student $student)
  {
      $marks = Marks::where('student_id', $student->id)->select('subject_id', 'total_marks', 'obtain_marks')->get();

      $std = new \stdClass();
      $std->name = $student->name;
      $std->father_name = $student->father_name;
      $std->roll_no = $student->roll_no;
      $std->contact = $student->contact;
      $std->total = 0;
      $std->obtain = 0;
      $std->remarks = '';

      $results = [];
      $grades = GradeSetting::all();

      foreach ($marks as $obj) {
        $result = new \stdClass();
        $result->subject = (DB::table('subjects')->Select('name')->where('id', $obj->subject_id)->first())->name;
        $result->total_marks = $obj->total_marks;
        $result->obtain_marks = $obj->obtain_marks;
        $result->percentage = (int) (($obj->obtain_marks*100)/$obj->total_marks);


        foreach ($grades as $grade) {
          $arr = explode('-', $grade->percentage);
          if ($result->percentage >= $arr[0] && $result->percentage <= $arr[1]) {
            $result->grade = $grade->grade;
          }
        }
        array_push($results, $result);
        $std->total = $std->total + $obj->total_marks;
        $std->obtain = $std->obtain + $obj->obtain_marks;
      }

      $std->results = $results;
      $per = (int) (($std->obtain*100)/$std->total);

      foreach ($grades as $grade) {
        $arr = explode('-', $grade->percentage);
        if ($per >= $arr[0] && $per <= $arr[1]) {
          $std->remarks = $grade->description;
        }
      }

      return json_encode($std);
  }
}
