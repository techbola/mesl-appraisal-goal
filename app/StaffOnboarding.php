<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class StaffOnboarding extends Model
{
    protected $table   = 'staff_onboarding';
    protected $guarded = ['StaffOnboardRef'];
    public $primaryKey = 'StaffOnboardRef';
    public $timestamps = false;

    public function staff_name()
    {
        return $this->belongsTo('MESL\User', 'StaffName');
    }

    public function staff_department()
    {
        return $this->belongsTO('MESL\CompanyDepartment', 'Department');
    }

    /*
    |-----------------------------------------
    | GET ON-BOARDING REQUEST
    |-----------------------------------------
    */
    public static function gellPendingOnboarding(){
        // body
        return StaffOnboarding::orderBy('StaffOnboardRef', 'DESC')->where('SendForApproval', '1')->get();
    }

    public function staff_type()
    {
        return $this->belongsTo(StaffType::class, 'StaffType');
    }
}
