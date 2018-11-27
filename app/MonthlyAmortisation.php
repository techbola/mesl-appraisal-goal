<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class MonthlyAmortisation extends Model
{
  protected $table   = 'tblMonthlyAmortisation';
  protected $guarded = ['MonthlyAmortRef'];
  public $primaryKey = 'MonthlyAmortRef';
  public $timestamps = false;

  public function item()
  {
    return $this->belongsTo('MESL\MonthlyAmortItem', 'MonthlyAmortItemID', 'MonthlyAmortItemRef');
  }

  public function glcredit()
  {
    return $this->belongsTo('MESL\GL', 'GLIDCredit', 'GLRef');
  }

  public function gldebit()
  {
    return $this->belongsTo('MESL\GL', 'GLIDDebit', 'GLRef');
  }

}
