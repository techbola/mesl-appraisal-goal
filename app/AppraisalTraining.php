<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AppraisalTraining extends Model
{
    protected $fillable = [
        'staffID', 'supervisorID', 'need',
    ];

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }
    
}
