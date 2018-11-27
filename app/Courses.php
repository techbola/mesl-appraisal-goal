<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table   = 'tblCourses';
    protected $guarded = ['course_ref'];
    public $primaryKey = 'course_ref';
    public $timestamps = false;
}
