<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
  protected $table   = 'tblSteps';
  protected $guarded = ['StepRef'];
  public $primaryKey = 'StepRef';

  public function task()
  {
    return $this->belongsTo('Cavidel\ProjectTask', 'TaskID');
  }
}
