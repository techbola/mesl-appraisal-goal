<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CallMemo extends Model
{
  protected $table   = 'tblCallMemo';
  protected $guarded = ['CallMemoRef'];
  public $primaryKey   = 'CallMemoRef';

  public function discussions()
  {
    return $this->hasMany('MESL\CallMemoDiscussion', 'CallMemoID');
  }


  public function customer()
  {
    return $this->belongsTo('MESL\Customer', 'CustomerID');
  }

  public function meeting_type()
  {
    return $this->belongsTo('MESL\CallMemoMeetingType', 'MeetingTypeID');
  }

  public function files()
  {
    return $this->hasMany('MESL\CallMemoFile', 'CallMemoID');
  }

}
