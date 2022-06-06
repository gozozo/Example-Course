<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('v1')->group(function (){
    Route::resource('instructor', InstructorController::class)->only(['index','show']);
    Route::resource('course', CourseController::class)->only(['show']);
    Route::resource('attendance', AttendanceController::class)->only(['store','destroy']);
});