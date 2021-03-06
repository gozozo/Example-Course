<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','start','end'];


     /**
     * Relationships
     */

    public function instructor (){
        return $this->belongsTo(Instructor::class);
    }

    public function students (){
        return $this->belongsToMany(Student::class, 'courses_students');
    }
}
