<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PayrollRecon extends Model
{
    protected $table      = 'tblPayrollRecon';
    protected $guarded    = ['RecRef'];
    protected $primaryKey = 'RecRef';
    public $timestamps    = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }

}
