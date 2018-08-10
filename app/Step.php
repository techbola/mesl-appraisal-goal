<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
  protected $table   = 'tblSteps';
  protected $guarded = ['StepRef'];
  public $primaryKey = 'StepRef';

  // public $appends = ['last_update'];

  public function task()
  {
    return $this->belongsTo('Cavidel\ProjectTask', 'TaskID');
  }

  public function getLastUpdateAttribute()
  {
    return StepBudget::where('StepID', $this->StepRef)->orderBy('created_at', 'desc')->first();
  }

  public function last_budget()
  {
    return $this->hasOne(StepBudget::class, 'StepID')->latest();
  }

  public function payments()
  {
    return $this->hasMany('Cavidel\StepBudgetPayment', 'StepID');
  }

  public function getPaymentMadeAttribute()
  {
    return $this->payments()->sum('Amount');
  }

  public function getPaymentOutstandingAttribute()
  {
    return $this->last_update->BudgetCost - $this->payments()->sum('Amount');
  }

}
