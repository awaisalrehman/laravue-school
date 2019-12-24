<?php

namespace App\Http\Controllers\Api;

use App\GradeSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradeSettingRequest;
use App\Http\Resources\GradeSetting as GradeSettingResource;
use App\Http\Resources\GradeSettingCollection;

class GradeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GradeSettingCollection(GradeSetting::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeSettingRequest $request, GradeSetting $grade)
    {
        $data = $request->all();
        $grade = $grade->create($data);

        return new GradeSettingResource($grade);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GradeSetting  $gradeSetting
     * @return \Illuminate\Http\Response
     */
    public function show(GradeSetting $grade)
    {
        return new GradeSettingResource($grade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GradeSetting  $gradeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(GradeSettingRequest $request, GradeSetting $grade)
    {
        $data = $request->all();
        $grade->update($data);

        return new GradeSettingResource($grade);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GradeSetting  $gradeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeSetting $grade)
    {
        $grade->delete();

        return new GradeSettingResource($grade);
    }
}
