<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
  protected $table   = 'tblNationality';
  protected $guarded = ['NationalityRef'];
  public $primaryKey = 'NationalityRef';
  public $timestamps = false;
}
