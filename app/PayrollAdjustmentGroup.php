<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollAdjustmentGroup extends Model
{
    protected $table   = 'tblPayrollAdjustmentGroup';
    protected $guarded = ['GroupRef'];
    public $timestamps = false;
}
