<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $table = 'tblChats';

  public $with = ['from', 'to'];

  public function from()
  {
    return $this->belongsTo('Cavi\User', 'FromID');
  }
  public function to()
  {
    return $this->belongsTo('Cavi\User', 'ToID');
  }

}
