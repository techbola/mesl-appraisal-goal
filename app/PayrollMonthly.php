<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class PayrollMonthly extends Model
{
    protected $table      = 'tblPayrollMonthly';
    protected $guarded    = ['PayrollRef'];
    protected $primaryKey = 'PayrollRef';
    public $timestamps    = false;

    // relate to users
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }
}
