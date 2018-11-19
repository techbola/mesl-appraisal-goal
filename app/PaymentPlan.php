<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
  protected $table   = 'tblPaymentPlan';
  protected $guarded = ['PaymentPlanRef'];
  public $primaryKey = 'PaymentPlanRef';
  public $timestamps = false;
}
