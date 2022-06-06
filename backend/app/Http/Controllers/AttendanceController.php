<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Http\Resources\AttendanceResource;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        $attendance = Attendance::attendaceByStudentByCourseByDay($request->student_id,$request->course_id,Carbon::now())->first();
        if($attendance == null){
            $attendance =Attendance::create($request->toArray());
        }
        return new AttendanceResource($attendance);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendances
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return response()->json([
            'data' => ['result'=>'ok']
        ]);
    }
}
