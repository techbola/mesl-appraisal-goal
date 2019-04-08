<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExitNotification extends Model
{
    protected $table   = 'tblExitNotification';
    protected $guarded = ['ExitNotificationRef'];
    public $timestamps = false;
    public $primaryKey   = 'ExitNotificationRef';

    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentID');
    }

    public function supervisor()
    {
        return $this->belongsTo(Staff::class, 'SupervisorID');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }

    public function exit_interview()
    {
        return $this->belongsTo(ExitInterview::class, 'ExitInterviewID');
    }
}
