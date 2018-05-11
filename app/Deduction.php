<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $table      = 'Honeywell.tblDeductions';
    protected $primaryKey = 'DeductionRef';
    protected $guarded    = ['DeductionRef'];
    public $timestamps    = false;
}
