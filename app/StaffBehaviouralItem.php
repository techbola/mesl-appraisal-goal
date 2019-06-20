<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class StaffBehaviouralItem extends Model
{
    protected $fillable = [
        'staffID', 'supervisorID', 'behaviouralCat_id', 'behaviouralItem_id', 'selfAssessment', 'supervisorAssessment',
        'supervisorComment', 'appraisal_id'
    ];

    public $primaryKey = 'id';

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staffID');
    }

    public function behaviouralItem()
    {
        return $this->belongsTo('MESL\BehaviouralItem', 'behaviouralItem_id');
    }

}
