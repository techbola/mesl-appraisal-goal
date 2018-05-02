<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
  protected $table   = 'tblProjectTasks';
  protected $guarded = ['TaskRef'];
  public $primaryKey = 'TaskRef';
  // public $dates = ['EndDate'];

  protected $appends = ['progress', 'progress_percent'];

  public function project()
  {
    return $this->belongsTo('App\Project', 'ProjectID', 'ProjectRef');
  }
  public function staff()
  {
    return $this->belongsTo('App\Staff', 'StaffID', 'StaffRef');
  }
  public function poster()
  {
    return $this->belongsTo('App\User', 'CreatedBy');
  }
  public function steps()
  {
    return $this->hasMany('App\Step', 'TaskID', 'TaskRef');
  }

  public function getProgressAttribute()
  {
    if(count($this->steps) > 0) {
      $progress = floor((count($this->StepsDone) / count($this->steps)) * 100);
    } else {
      $progress = 0;
    }
    return $progress;

  }

  public function getProgressPercentAttribute()
  {
    return $this->progress.'%';
  }

  public function getStepsDoneAttribute()
  {
    return $this->steps->where('Done', '1');
  }

  public function getStepsUndoneAttribute()
  {
    return $this->steps->where('Done', '0');
  }

}
