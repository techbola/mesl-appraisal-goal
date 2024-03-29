<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use SoftDeletes;

    protected $table   = 'tblLeaveRequest';
    protected $guarded = ['LeaveRequestRef'];

    // public $primaryKey   = 'CompanyRef';
    public $primaryKey = 'LeaveReqRef';
    public $timestamps = false;
    protected $dates   = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('MESL\User', 'ApproverID');
    }

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'SupervisorID');
    }

    public function rejector()
    {
        return $this->belongsTo('MESL\Staff', 'RejectedBy');
    }

    public function leave_type()
    {
        return $this->belongsTo('MESL\LeaveType', 'AbsenceTypeID');
    }

    public function requester()
    {
        return $this->belongsTo('MESL\User', 'StaffID');
    }

    public function supervisor()
    {
        return $this->belongsTo('MESL\Staff', 'SupervisorID');
    }

    public function get_department()
    {
        return $this->belongsTo('MESL\CompanyDepartment', 'DepartmentID');
    }

    public function handovers()
    {
        return $this->hasMany(HandOverNote::class, 'LeaveRequestID', 'LeaveReqRef');
    }

    public static function leave_with_pay($from, $to)
    {
        return LeaveRequest::where('LeaveAllowance', 'With Pay')
            ->whereBetween('StartDate', [$from, $to])->get();
    }

    public function current_approver()
    {
        $approver_id = $this->ApproverID;
        if ($approver_id != null) {
            // return User::find($approver_id)->fullName;
            return $this->belongsTo(User::class, 'ApproverID');
        } else {
            return null;
        }
    }

    public function relief_officer()
    {
        return $this->belongsTo(User::class, 'ReliefOfficerID', 'id');
    }

    public function hr_staff()
    {
        return $this->belongsTo(User::class, 'HRStaffID', 'id');
    }
}
