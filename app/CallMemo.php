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

  public function meeting_type()
  {
    return $this->belongsTo('Cavidel\CallMemoMeetingType', 'MeetingTypeID');
  }

  public function files()
  {
    return $this->hasMany('Cavidel\CallMemoFile', 'CallMemoID');
  }

}
