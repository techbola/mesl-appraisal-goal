<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class MonthlyAmortisation extends Model
{
  protected $table   = 'tblMonthlyAmortisation';
  protected $guarded = ['MonthlyAmortRef'];
  public $primaryKey = 'MonthlyAmortRef';
  public $timestamps = false;

  public function item()
  {
    return $this->belongsTo('Cavidel\MonthlyAmortItem', 'MonthlyAmortItemID', 'MonthlyAmortItemRef');
  }

  public function glcredit()
  {
    return $this->belongsTo('Cavidel\GL', 'GLIDCredit', 'GLRef');
  }

  public function gldebit()
  {
    return $this->belongsTo('Cavidel\GL', 'GLIDDebit', 'GLRef');
  }

}
