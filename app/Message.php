<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $table   = 'tblMessages';
  protected $guarded = ['MessageRef'];
  public $primaryKey = 'MessageRef';

  public function sender()
  {
    return $this->belongsTo('MESL\User', 'FromID');
  }

  public function recipients()
  {
    return $this->belongsToMany('MESL\User', 'tblMessageRecipients', 'MessageID', 'UserID')->withPivot('IsRead', 'IsDeleted');
  }

  public function replies()
  {
      return $this->hasMany('MESL\Message', 'ParentID', 'MessageRef')->orderBy('created_at', 'desc');
  }

  public function files()
  {
      return $this->hasMany(MessageFile::class, 'MessageID');
  }

}
