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

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }

    public function options_rel()
    {
        return $this->belongsTo(Options::class, 'WorkRelationship');
    }

    public function options_sup()
    {
        return $this->belongsTo(Options::class, 'SupervisorRelationship');
    }

    public function options_job()
    {
        return $this->belongsTo(Options::class, 'JobExpectations');
    }

    public function options_work_assignment()
    {
        return $this->belongsTo(Options::class, 'WorkAssignment');
    }

    public function options_job_understanding()
    {
        return $this->belongsTo(Options::class, 'JobUnderstanding');
    }

    public function options_work_condition()
    {
        return $this->belongsTo(Options::class, 'WorkConditions');
    }

    public function options_work_pay()
    {
        return $this->belongsTo(Options::class, 'WorkPay');
    }

    public function options_work_benefit()
    {
        return $this->belongsTo(Options::class, 'WorkBenefit');
    }

    public function options_work_schedule()
    {
        return $this->belongsTo(Options::class, 'WorkSchedule');
    }

    public function options_work_satisfaction()
    {
        return $this->belongsTo(Options::class, 'WorkSatisfaction');
    }

    public function obligation()
    {
        return $this->belongsTo(Obligation::class, 'ObligationID');
    }

    public function hr_officer()
    {
        return $this->belongsTo(User::class, 'HROfficerID');
    }
}
