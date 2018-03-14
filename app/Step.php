<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
  protected $table   = 'tblSteps';
  protected $guarded = ['StepRef'];
  public $primaryKey = 'StepRef';
}
