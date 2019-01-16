<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class HandoverTask extends Model
{
    protected $table   = 'tblHandoverTask';
    protected $guarded = ['HandoverTaskRef'];
    public $timestamps = false;

    public function releief_officer()
    {
        return $this->belongsTo('MESL\Staff', 'ReliefOfficer');
    }

    public function leave_type()
    {
        return $this->belongsTo('MESL\LeaveType', 'AbsenceTypeID');
    }
}
