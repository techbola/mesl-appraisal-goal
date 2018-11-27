<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
  protected $table   = 'tblProjectTasks';
  protected $guarded = ['TaskRef'];
  public $primaryKey = 'TaskRef';
  // public $dates = ['EndDate'];

  public $with = ['steps'];

  protected $appends = ['progress', 'progress_percent'];

  public function project()
  {
    return $this->belongsTo('MESL\Project', 'ProjectID', 'ProjectRef');
  }
  public function staff()
  {
    return $this->belongsTo('MESL\Staff', 'StaffID', 'StaffRef');
  }
  public function poster()
  {
    return $this->belongsTo('MESL\User', 'CreatedBy');
  }
  public function steps()
  {
    return $this->hasMany('MESL\Step', 'TaskID', 'TaskRef');
  }
  public function updates()
  {
    return $this->hasMany('MESL\TaskUpdate', 'TaskID', 'TaskRef')->orderBy('created_at', 'desc');
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
