<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class BuildingProject extends Model
{
  protected $table   = 'tblBuildingProjects';
  protected $guarded = ['BuildingProjectRef'];
  public $primaryKey = 'BuildingProjectRef';
  public $timestamps = false;
}
