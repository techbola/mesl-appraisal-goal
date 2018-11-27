<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  protected $table   = 'tblTodo';
  protected $guarded = ['TodoRef'];
  public $timestamps = false;
  public $primaryKey = 'TodoRef';

  public function user()
  {
    return $this->belongsTo('MESL\User', 'UserID');
  }

  public function initiator()
  {
    return $this->belongsTo('MESL\User', 'Initiator');
  }

}
