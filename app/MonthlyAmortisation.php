<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyAmortisation extends Model
{
  protected $table   = 'tblMonthlyAmortisation';
  protected $guarded = ['MonthlyAmortRef'];
  public $primaryKey = 'MonthlyAmortRef';
  public $timestamps = false;

  public function item()
  {
    return $this->belongsTo('App\MonthlyAmortItem', 'MonthlyAmortItemID', 'MonthlyAmortItemRef');
  }

  public function glcredit()
  {
    return $this->belongsTo('App\GL', 'GLIDCredit', 'GLRef');
  }

  public function gldebit()
  {
    return $this->belongsTo('App\GL', 'GLIDDebit', 'GLRef');
  }

}
