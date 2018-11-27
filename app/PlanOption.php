<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class PlanOption extends Model
{
    protected $table   = 'tblPlanOption';
    protected $guarded = ['OptionRef'];
    public $primaryKey = 'OptionRef';
    public $timestamps = false;
}
