<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class EstateAllocation extends Model
{
  protected $table   = 'tblAllocation';
  protected $guarded = ['AllocationRef'];
  protected $primaryKey   = 'AllocationRef';

  public function info()
  {
    return $this->belongsTo(EstateInfo::class, 'EstateInfoID');
  }

  public function estate()
  {
    return $this->belongsTo(BuildingProject::class, 'EstateID');
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class, 'CustomerID');
  }

}
