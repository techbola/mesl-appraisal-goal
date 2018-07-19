<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $table = 'tblChats';

  public $with = ['from', 'to'];

  public function from()
  {
    return $this->belongsTo('Cavidel\User', 'FromID');
  }
  public function to()
  {
    return $this->belongsTo('Cavidel\User', 'ToID');
  }

}
