<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ProcessSteps extends Model
{
    protected $table   = 'tblProcessSteps';
    protected $guarded = ['ProcessStepRef'];
    public $primaryKey = 'ProcessStepRef';
    public $timestamps = false;
}
