<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AppraisalInternal extends Model
{
    protected $fillable = [
        'staffID', 'supervisorID', 'objective', 'kpi', 'target', 'selfAssessment', 'constraint',
        'supervisorAssessment', 'weight', 'justification', 'appraisal_id', 'hrComment',
    ];

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }
    
}
