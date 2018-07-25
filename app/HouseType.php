<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class HouseType extends Model
{
  protected $table   = 'tblHouseType';
  protected $guarded = ['HouseTypeRef'];
  public $primaryKey = 'HouseTypeRef';
  public $timestamps = false;
}
