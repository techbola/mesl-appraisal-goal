<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class TaskUpdate extends Model
{
  protected $table   = 'tblTaskUpdates';
  protected $guarded = ['UpdateRef'];
  public $primaryKey = 'UpdateRef';

  public function staff()
  {
    return $this->belongsTo('Cavi\Staff', 'StaffID', 'StaffRef');
  }

  public function task()
  {
    return $this->belongsTo('Cavi\ProjectTask', 'TaskID', 'TaskRef');
  }

}
