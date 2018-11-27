<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class PayrollLevel extends Model
{
    protected $table      = 'tblScenario';
    protected $guarded    = ['ScenarioRef'];
    protected $primaryKey = 'ScenarioRef';
    public $timestamps    = false;
}
