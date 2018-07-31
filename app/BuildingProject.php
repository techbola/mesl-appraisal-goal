<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class BuildingProject extends Model
{
  protected $table   = 'tblBuildingProjects';
  protected $guarded = ['BuildingProjectRef'];
  public $primaryKey = 'BuildingProjectRef';
  public $timestamps = false;

  public function blocks()
  {
    return $this->hasMany(EstateAllocation::class, 'EstateID');
  }

  public function units($block)
  {
    return $this->hasMany(EstateAllocation::class, 'EstateID')->where('Block', $block)->get();
  }


  public function estate_units()
  {
    return $this->hasMany(EstateAllocation::class, 'EstateID');
  }

}
