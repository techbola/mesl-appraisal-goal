<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class CallMemo extends Model
{
  protected $table   = 'tblCallMemo';
  protected $guarded = ['CallMemoRef'];
  public $primaryKey   = 'CallMemoRef';

  public function discussions()
  {
    return $this->hasMany('Cavi\CallMemoDiscussion', 'CallMemoID');
  }


  public function customer()
  {
    return $this->belongsTo('Cavi\Customer', 'CustomerID');
  }

  public function meeting_type()
  {
    return $this->belongsTo('Cavi\CallMemoMeetingType', 'MeetingTypeID');
  }

  public function files()
  {
    return $this->hasMany('Cavi\CallMemoFile', 'CallMemoID');
  }

}
