<?php


Route::get('/', function () {
    return view('students.index');
});


Route::view('students', 'students.index')->name('students.index');
Route::view('studentsubjects', 'students.subjects')->name('student.subjects');
Route::view('subjects', 'subjects.index')->name('subjects.index');
Route::view('grades', 'grades.index')->name('grades.index');
Route::view('marks', 'marks.index')->name('marks.index');
Route::view('results', 'results.studentList')->name('results.studentList');
