<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    protected $table   = 'tblCourseMaterial';
    protected $guarded = ['course_material_Ref'];
    public $primaryKey = 'course_material_Ref';
    public $timestamps = false;
}
