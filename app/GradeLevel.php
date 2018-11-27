<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    protected $table   = 'tblPayrollAdjustmentGroup';
    protected $guarded = ['GroupRef'];
    public $timestamps = false;
}
