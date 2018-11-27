<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    protected $table   = 'tblCourseInstructor';
    protected $guarded = ['course_instructor_ref'];
    public $primaryKey = 'course_instructor_ref';
    public $timestamps = false;
}
