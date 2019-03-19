<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class HMOPlan extends Model
{
    protected $table   = 'tblHMOPlan';
    protected $guarded = ['HMOPlanRef'];
    protected $primaryKey = 'HMOPlanRef';
    public $timestamps = false;
}
