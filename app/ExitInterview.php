<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExitInterview extends Model
{
    protected $table   = 'tblExitInterview';
    protected $guarded = ['ExitInterviewRef'];
    public $timestamps = false;
    public $primaryKey   = 'ExitInterviewRef';

    public function exit_reason()
    {
        return $this->belongsTo(ExitReason::class, 'ExitReasonID');
    }

    public function relocation()
    {
        return $this->belongsTo(RelocationReason::class, 'RelocationReasonID');
    }

    public function employment_reason()
    {
        return $this->belongsTo(EmploymentReason::class, 'EmploymentReasonID');
    }

    public function department()
    {
    return $this->belongsTo(Department::class, 'DepartmentID');
    }

    public function status()
    {
        if ($this->NotifyFlag == 0) {
            return 'Not Sent';
        } else {
            return  true;
        }
        
    }
}
