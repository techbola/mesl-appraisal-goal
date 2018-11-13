<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $table   = 'tblMessages';
  protected $guarded = ['MessageRef'];
  public $primaryKey = 'MessageRef';

  public function sender()
  {
    return $this->belongsTo('Cavi\User', 'FromID');
  }

  public function recipients()
  {
    return $this->belongsToMany('Cavi\User', 'tblMessageRecipients', 'MessageID', 'UserID')->withPivot('IsRead', 'IsDeleted');
  }

  public function replies()
  {
      return $this->hasMany('Cavi\Message', 'ParentID', 'MessageRef')->orderBy('created_at', 'desc');
  }

  public function files()
  {
      return $this->hasMany(MessageFile::class, 'MessageID');
  }

}
