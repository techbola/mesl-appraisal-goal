<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class StepBudget extends Model
{
  protected $table   = 'tblStepBudgets';
  protected $guarded = ['id'];

  public function step()
  {
    return $this->belongsTo('Cavidel\Step', 'StepID');
  }


}