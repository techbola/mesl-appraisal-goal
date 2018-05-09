<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollMonthly extends Model
{
    protected $table   = 'tblPayrollMonthly';
    protected $guarded = ['PayrollRef'];
    public $timestamps = false;

    // relate to users
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
