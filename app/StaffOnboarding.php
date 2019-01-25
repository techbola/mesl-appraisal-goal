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
}
