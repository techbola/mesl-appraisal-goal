<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class HMOPlan extends Model
{
    protected $table   = 'tblHMOPlan';
    protected $guarded = ['HMOPlanRef'];
    public $timestamps = false;
}
