<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class MonthlyAmortisation extends Model
{
  protected $table   = 'tblMonthlyAmortisation';
  protected $guarded = ['MonthlyAmortRef'];
  public $primaryKey = 'MonthlyAmortRef';
  public $timestamps = false;

  public function item()
  {
    return $this->belongsTo('Cavi\MonthlyAmortItem', 'MonthlyAmortItemID', 'MonthlyAmortItemRef');
  }

  public function glcredit()
  {
    return $this->belongsTo('Cavi\GL', 'GLIDCredit', 'GLRef');
  }

  public function gldebit()
  {
    return $this->belongsTo('Cavi\GL', 'GLIDDebit', 'GLRef');
  }

}
