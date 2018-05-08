<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyAmortItem extends Model
{
  protected $table   = 'tblMonthlyAmortItem';
  protected $guarded = ['MonthlyAmortItemRef'];
  public $primaryKey = 'MonthlyAmortItemRef';
  public $timestamps = false;
}
