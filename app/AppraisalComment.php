<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AppraisalComment extends Model
{
    protected $fillable = [
        'staffID', 'supervisorID', 'appraiseeComment', 'appraiserComment', 'appraisal_id',
    ];

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }
    
}
