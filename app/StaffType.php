<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class StaffType extends Model
{
    protected $table   = 'tblStaffType';
    protected $guarded = ['StaffTypeRef'];
    protected $primaryKey = 'StaffTypeRef';
    public $timestamps = false;
}
