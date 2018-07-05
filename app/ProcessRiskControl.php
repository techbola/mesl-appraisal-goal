<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ProcessRiskControl extends Model
{
    protected $table   = 'tblProcessRiskControl';
    protected $guarded = ['process_risk_control_ref'];
    public $timestamps = false;
}
