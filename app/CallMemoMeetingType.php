<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class CallMemoMeetingType extends Model
{
  protected $table   = 'tblCallMemoMeetingType';
  protected $guarded = ['MeetingTypeRef'];
  public $primaryKey   = 'MeetingTypeRef';

}
