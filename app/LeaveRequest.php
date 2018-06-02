<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table   = 'tblLeaveRequest';
    protected $guarded = ['LeaveRequestRef'];

    public $primaryKey   = 'CompanyRef';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('Cavidel\User', 'ApproverID');
    }

    public function leave_type()
    {
        return $this->belongsTo('Cavidel\LeaveType', 'AbsenceTypeID');
    }
}
