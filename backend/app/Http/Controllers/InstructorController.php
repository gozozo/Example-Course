<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\InstructorResource;
use App\Models\Instructor;


class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InstructorResource::collection(Instructor::select(['id','first_name','last_name','email'])->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        return new InstructorResource($instructor->load('courses:id,name,description,instructor_id'));
    }
}
