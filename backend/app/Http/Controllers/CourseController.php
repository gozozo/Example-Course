<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Carbon\Carbon;

class CourseController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return new CourseResource($course->load(['instructor','students' => function ($query) use ($course){
            $query->select(['id','first_name','last_name','email'])->with(['attendances'=> function($query) use ($course){
                $query->atDay(Carbon:now())->atCourse($course->id);
            }]);
        }]));
        return new CourseResource($course->load(['instructor','students:'],));
    }

}
