<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $table   = 'tblMessages';
  protected $guarded = ['MessageRef'];
  public $primaryKey = 'MessageRef';

  public function sender()
  {
    return $this->belongsTo('App\User', 'FromID');
  }

  public function recipients()
  {
    return $this->belongsToMany('App\User', 'tblMessageRecipients', 'MessageID', 'UserID')->withPivot('IsRead', 'IsDeleted');
  }

  public function replies()
  {
      return $this->hasMany('App\Message', 'ParentID', 'MessageRef');
  }

}
