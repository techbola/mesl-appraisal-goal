<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table   = 'tblCourseCategory';
    protected $guarded = ['course_category_ref'];
    public $primaryKey = 'course_category_ref';
    public $timestamps = false;
}
