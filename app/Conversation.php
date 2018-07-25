<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
  protected $table   = 'tblConversations';
  protected $guarded = ['ConversationRef'];
  public $primaryKey   = 'ConversationRef';
}
