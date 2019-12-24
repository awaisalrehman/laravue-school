<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Marks;
use Illuminate\Http\Request;

class MarksController extends Controller
{

    public function store(Request $request)
    {
      $data = $request->all();


      for ($i=0; $i < count($data); $i++) {
        unset($data[$i]['student_name']);
        unset($data[$i]['student_roll_no']);

        $marks = Marks::where(['student_id'=> $data[$i]['student_id'], 'subject_id'=> $data[$i]['subject_id']])->first();

        if (empty($marks)) {
          $marks = new Marks;
        }

        $marks->fill($data[$i])->save();
      }
    }
}
