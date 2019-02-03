<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class IdcardRequest extends Model
{
    protected $table   = 'idcard_request';
    protected $guarded = ['IDcardRequestRef'];
    public $primaryKey = 'IDcardRequestRef';
    public $timestamps = false;

    public function requester_name()
    {
        return $this->belongsTo('MESL\User', 'EmployeeName');
    }

    public function staff_department()
    {
        return $this->belongsTO('MESL\CompanyDepartment', 'Department');
    }

    // public function request_approver()
    // {
    //     return $this->belongsTo('MESL\')
    // }
}
