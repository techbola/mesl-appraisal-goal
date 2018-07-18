<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $table = 'tblChats';

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
}
