<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class MessageRecipient extends Model
{
  protected $table   = 'tblMessageRecipients';
  public $timestamps = false;
}
