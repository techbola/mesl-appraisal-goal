<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PayrollAdjustmentGroup extends Model
{
    protected $table   = 'tblPayrollAdjustmentGroup';
    protected $guarded = ['GroupRef'];
    public $primaryKey = 'GroupRef';
    public $timestamps = false;

    public function seniority_level()
    {
        return $this->belongsTo(SeniorityLevel::class, 'SeniorityLevel');
    }

    public function scenario()
    {
        return $this->belongsTo(PayrollLevel::class, 'Scenario');
    }
}
