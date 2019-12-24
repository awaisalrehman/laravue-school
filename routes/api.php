<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::apiResource('students', 'StudentController');
    Route::apiResource('subjects', 'SubjectController');
    Route::apiResource('grades', 'GradeSettingController');
    Route::get('students/{student}/unassignedsubjects', 'StudentController@unassignedSubjects');
    Route::get('students/{student}/assignedsubjects', 'StudentController@assignedSubjects');
    Route::post('students/{student}/assignsubject/{subject}', 'StudentController@assignSubject');
    Route::delete('students/{student}/deletesubject/{subject}', 'StudentController@deleteSubject');
    Route::get('results/students', 'ResultController@students');
    Route::get('results/student/{student}', 'ResultController@result');
    Route::get('subjectlist', 'SubjectController@subjectList');
    Route::get('subjectstudents/subject/{subject}', 'SubjectController@subjectStudents');
    Route::post('subjectresult', 'MarksController@store');
});
