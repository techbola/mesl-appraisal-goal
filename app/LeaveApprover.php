<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class LeaveApprover extends Model
{
    protected $table   = 'tblLeaveApprover';
    protected $guarded = ['ApproverRef'];
    public $timestamps = false;
    public $primaryKey = 'ApproverRef';

    public function staff()
    {
        return $this->belongsTo('Cavidel\Staff', 'StaffID');
    }
    public function getFullNameAttribute()
    {
        return $this->staff->FullName;
    }
}