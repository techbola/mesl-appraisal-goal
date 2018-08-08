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

  public function getLastUpdateAttribute()
  {
    return StepUpdate::where('StepID', $this->StepRef)->orderBy('created_at', 'desc')->first();
  }
}
