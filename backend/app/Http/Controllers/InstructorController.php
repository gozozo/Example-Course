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
        return InstructorResource::collection(Instructor::all()->load('courses'));
    }
}
