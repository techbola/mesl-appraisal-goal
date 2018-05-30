<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CallMemo extends Model
{
  protected $table   = 'tblCallMemo';
  protected $guarded = ['CallMemoRef'];
  public $primaryKey   = 'CallMemoRef';

  public function discussions()
  {
    return $this->hasMany('Cavidel\CallMemoDiscussion', 'CallMemoID');
  }


  public function customer()
  {
    return $this->belongsTo('Cavidel\Customer', 'CustomerID');
  }

}
