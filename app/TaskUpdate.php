<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class TaskUpdate extends Model
{
  protected $table   = 'tblTaskUpdates';
  protected $guarded = ['UpdateRef'];
  public $primaryKey = 'UpdateRef';
}
