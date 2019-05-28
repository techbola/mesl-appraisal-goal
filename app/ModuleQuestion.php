<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ModuleQuestion extends Model
{
    protected $table   = 'tblModuleQuestion';
    protected $guarded = ['ModuleQuestionRef'];
    public $primaryKey = 'ModuleQuestionRef';
    public $timestamps = false;

    public function course_module()
    {
        return $this->belongsTo(CourseModule::class, 'ModuleID');
    }

}
