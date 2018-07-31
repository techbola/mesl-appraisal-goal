<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $table   = 'tblCustomer';
  protected $guarded = ['CustomerRef'];
  public $primaryKey = 'CustomerRef';
  public $timestamps = false;

  public function projects()
  {
    return $this->hasMany('Cavidel\Project', 'ClientID');
  }

  public function estate_allocation()
  {
    return $this->hasOne('Cavidel\EstateAllocation', 'CustomerID');
  }

}
