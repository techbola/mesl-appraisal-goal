<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class TaskUpdate extends Model
{
  protected $table   = 'tblTaskUpdates';
  protected $guarded = ['UpdateRef'];
  public $primaryKey = 'UpdateRef';

  public function staff()
  {
    return $this->belongsTo('Cavidel\Staff', 'StaffID', 'StaffRef');
  }

  public function task()
  {
    return $this->belongsTo('Cavidel\ProjectTask', 'TaskID', 'TaskRef');
  }

}
