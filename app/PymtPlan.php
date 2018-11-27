<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class PymtPlan extends Model
{
    protected $table   = 'tblPymtPlan';
    protected $guarded = ['PlanRef'];
    public $primaryKey = 'PlanRef';
    public $timestamps = false;
}
