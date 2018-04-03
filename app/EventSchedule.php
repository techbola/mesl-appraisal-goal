<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
  protected $table   = 'tblEventSchedule';
  protected $guarded = ['EventRef'];
  protected $primaryKey   = 'EventRef';

  public function poster()
  {
    return $this->belongsTo('App\User', 'Initiator');
  }

}
