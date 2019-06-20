<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{

	protected $table = 'appraisal';
	
    protected $fillable = [
        'staffID', 'supervisorID', 'employee_name', 'job_position', 'department', 'period', 'appraiserDesignation',
        'appraiserName', 'status', 'sentFlag', 'supervisorComment',
    ];

    protected $primaryKey = 'id';

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }

}
