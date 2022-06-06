<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id','student_id'];

     /**
     * Filter Attendance by day.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function scopeAtDay(Builder $builder, Carbon $date)
    {
        $builder->whereBetween('attendances.created_at', [$date->copy()->startOfDay(),$date->copy()->endOfDay()]);
    }
    /**
     * Filter Attendance by course.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  int  $courseId
     * @return void
     */
    public function scopeAtCourse(Builder $builder, int $courseId)
    {
        $builder->where('attendances.course_id',$courseId );
    }

    /**
     * Filter Attendance by student by course by day.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  int  $studentId
     * @param  int  $courseId
     * @param  Carbon  $date
     * @return void
     */
    public function scopeAttendaceByStudentByCourseByDay(Builder $builder, int $studentId,int $courseId, Carbon $date)
    {
        $builder->where('student_id',$studentId)->atCourse($courseId)->atDay($date);
    }
}
