<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AppraisalRecommendation extends Model
{
    protected $fillable = [
        'staffID', 'supervisorID', 'promote', 'commendation', 'performance', 'exit',
    ];

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }
    
}
