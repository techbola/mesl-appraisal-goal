<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table   = 'tblLeaveType';
    protected $guarded = ['LeaveTypeRef'];
    public $timestamps = false;
    public $primaryKey   = 'LeaveTypeRef';

    // public function leave_request()
    // {
    //     return $this->belongsTo('Cavidel\LeaveRequest', 'AbsenceTypeID');
    // }

}
