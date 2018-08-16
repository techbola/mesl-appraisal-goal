<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class StepBudgetPayment extends Model
{
  protected $table   = 'tblStepBudgetPayments';
  protected $guarded = ['PaymentRef'];
  public $primaryKey = 'PaymentRef';

  public function step()
  {
    return $this->belongsTo('Cavidel\Step', 'StepID');
  }

  public function inputter()
  {
    return $this->belongsTo('Cavidel\User', 'InputterID');
  }

}
