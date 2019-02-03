<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table   = 'tblLeaveRequest';
    protected $guarded = ['LeaveRequestRef'];

    // public $primaryKey   = 'CompanyRef';
    public $primaryKey = 'LeaveReqRef';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('MESL\User', 'ApproverID');
    }

    public function leave_type()
    {
        return $this->belongsTo('MESL\LeaveType', 'AbsenceTypeID');
    }

    public function requester()
    {
        return $this->belongsTo('MESL\User', 'StaffID');
    }

    public function get_department()
    {
        return $this->belongsTo('MESL\CompanyDepartment', 'DepartmentID');
    }
}
