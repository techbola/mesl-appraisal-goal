<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PayrollRate extends Model
{
    protected $table   = 'tblPayrollRates';
    protected $guarded = ['RateRef'];

    public $primaryKey = 'RateRef';

    public $timestamps = false;
}
