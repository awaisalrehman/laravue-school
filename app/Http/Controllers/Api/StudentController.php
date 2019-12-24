<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use App\Student;
use App\Subject;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StudentCollection(Student::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request, Student $student)
    {
        $data = $request->all();
        $student = $student->create($data);

        return new StudentResource($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $data = $request->all();
        $student->update($data);

        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return new StudentResource($student);
    }

        public function unassignedSubjects(Student $student)
        {
          $ids = [];
          foreach ($student->subjects as $subject) {
            array_push($ids, $subject->id);
          }

          $subjects = Subject::whereNotIn('id', $ids)->get();

          return $subjects;

        }

        public function assignedSubjects(Student $student)
        {
          return $student->subjects;
        }

      public function assignSubject(Student $student, Subject $subject)
      {
        $student->subjects()->attach($subject->id);
      }

      public function deleteSubject(Student $student, Subject $subject)
      {
        $student->subjects()->detach($subject->id);
      }
}
