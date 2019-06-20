<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AppraisalSignature extends Model
{
    protected $fillable = [
        'staffID', 'supervisorID', 'appraiseeSign', 'appraiserSign', 'executiveSign', 'hrSign', 'appraisal_id',
    ];

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }
    
}
