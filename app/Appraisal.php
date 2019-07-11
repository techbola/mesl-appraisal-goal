<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{

	protected $table = 'appraisal';
	
    protected $fillable = [
        'staffID', 'supervisorID', 'hrID', 'employee_name', 'job_position', 'department', 'period', 'appraiserDesignation',
        'appraiserName', 'status', 'sentFlag', 'supervisorComment', 'appraisalStatus', 'startAppraisalFlag'
    ];

    protected $primaryKey = 'id';

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }

    public function getHrFullName($hrID)
    {

        $hr = Staff::where('StaffRef', $hrID)->first();

        return $hr->user;

    }

}
