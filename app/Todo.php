<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  protected $table   = 'tblTodo';
  protected $guarded = ['TodoRef'];
  public $timestamps = false;
  public $primaryKey = 'TodoRef';

  public function user()
  {
    return $this->belongsTo('Cavi\User', 'UserID');
  }

  public function initiator()
  {
    return $this->belongsTo('Cavi\User', 'Initiator');
  }

}
