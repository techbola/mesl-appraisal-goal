<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table   = 'tblCourseCategory';
    protected $guarded = ['CourseCategoryRef'];
    public $primaryKey = 'CourseCategoryRef';
    public $timestamps = false;
}
