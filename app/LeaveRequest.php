<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table   = 'tblLeaveRequest';
    protected $guarded = ['LeaveRequestRef'];

    public $primaryKey   = 'CompanyRef';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('Cavi\User', 'ApproverID');
    }

    public function leave_type()
    {
        return $this->belongsTo('Cavi\LeaveType', 'AbsenceTypeID');
    }


    public function requester()
    {
        return $this->belongsTo('Cavi\User', 'StaffID');
    }
}
