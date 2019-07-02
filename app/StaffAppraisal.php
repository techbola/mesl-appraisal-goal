<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class StaffAppraisal extends Model
{

    protected $fillable = [
        'staff_id', 'appraisal_id', 'staffFinancialScore', 'staffCustomerScore', 'staffInternalScore', 'staffLearningScore',
        'supervisorFinancialScore', 'supervisorCustomerScore', 'supervisorInternalScore', 'supervisorLearningScore',
        'bscStaffScore', 'bscSupervisorScore', 'staffBehavioural', 'supervisorBehavioural', 'overallStaffScore',
        'overallSupervisorScore', 'period',
    ];

    public $primaryKey = 'id';

    public function staff()
    {
        return $this->belongsTo('MESL\Staff', 'staff_id');
    }

}
