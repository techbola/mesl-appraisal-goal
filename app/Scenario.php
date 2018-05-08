<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    protected $table   = 'tblScenario';
    protected $guarded = ['ScenarioRef'];
    public $timestamps = false;
}