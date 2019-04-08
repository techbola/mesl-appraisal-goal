<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    protected $table   = 'tblCourseModule';
    protected $guarded = ['ModuleRef'];
    public $primaryKey = 'ModuleRef';
    public $timestamps = false;

    public function course()
    {
        return $this->belongsTo(Courses::class, 'CourseID');
    }

    public function course_material()
    {
        return $this->hasMany(CourseMaterial::class, 'module_id');
    }

    public function module_question()
    {
        return $this->hasMany(ModuleQuestion::class, 'ModuleID');
    }

}
