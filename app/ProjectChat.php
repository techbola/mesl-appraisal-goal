<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ProjectChat extends Model
{
  protected $table   = 'tblProjectChat';
  protected $guarded = ['ChatRef'];
  public $primaryKey = 'ChatRef';

  public function staff()
  {
    return $this->belongsTo('Cavidel\Staff', 'StaffID', 'StaffRef');
  }

  public function project()
  {
    return $this->belongsTo('Cavidel\Project', 'ProjectID', 'ProjectRef');
  }

}
