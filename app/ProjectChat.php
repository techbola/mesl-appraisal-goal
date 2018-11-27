<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ProjectChat extends Model
{
  protected $table   = 'tblProjectChat';
  protected $guarded = ['ChatRef'];
  public $primaryKey = 'ChatRef';

  public function staff()
  {
    return $this->belongsTo('MESL\Staff', 'StaffID', 'StaffRef');
  }

  public function project()
  {
    return $this->belongsTo('MESL\Project', 'ProjectID', 'ProjectRef');
  }

}
