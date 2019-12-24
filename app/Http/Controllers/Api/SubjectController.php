<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Subject;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\Subject as SubjectResource;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\StudentCollection;
use DB;
use App\Marks;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SubjectCollection(Subject::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request, Subject $subject)
    {
        $data = $request->all();
        $subject = $subject->create($data);

        return new SubjectResource($subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return new SubjectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $data = $request->all();
        $subject->update($data);

        return new SubjectResource($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return new SubjectResource($subject);
    }

    public function subjectList()
    {
        $data = DB::select('SELECT subjects.id, subjects.name FROM `subjects` ORDER BY subjects.name ASC');
        return json_encode(array('data' => $data));
    }

    public function subjectStudents(Subject $subject)
    {
      // return new StudentCollection($subject->students);
      $marks = [];
      foreach ($subject->students as $student) {
        $m = new \stdClass();
        $m->student_id = $student->id;
        $m->student_name = $student->name;
        $m->student_roll_no = $student->roll_no;
        $m->subject_id = $subject->id;
        $r = Marks::where(['student_id' => $student->id, 'subject_id' => $subject->id])->first();
        if (!empty($r)) {
            $m->total_marks = $r->total_marks;
            $m->obtain_marks = $r->obtain_marks;
        }else {
          $m->total_marks = '';
          $m->obtain_marks = '';
        }
        array_push($marks, $m);
      }
      return $marks;
    }
}
