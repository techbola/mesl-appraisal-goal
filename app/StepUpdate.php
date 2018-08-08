<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class StepUpdate extends Model
{
  protected $table   = 'tblStepUpdates';
  protected $guarded = ['id'];

  public function step()
  {
    return $this->belongsTo('Cavidel\Step', 'StepID');
  }


}
