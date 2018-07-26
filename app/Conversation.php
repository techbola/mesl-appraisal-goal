<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
  protected $table   = 'tblConversations';
  protected $guarded = ['ConversationRef'];
  public $primaryKey   = 'ConversationRef';

  public function assignedto()
  {
    return $this->belongsTo(User::class, 'AssignedStaff');
  }
  public function inputter()
  {
    return $this->belongsTo(User::class, 'InputterID');
  }
}
