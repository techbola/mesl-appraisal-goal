<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PymtPlan extends Model
{
    protected $table   = 'tblPymtPlan';
    protected $guarded = ['PymtPlanRef'];
    public $primaryKey = 'PymtPlanRef';
    public $timestamps = false;
}
