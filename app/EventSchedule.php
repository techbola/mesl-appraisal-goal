<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
  protected $table   = 'tblEventSchedule';
  protected $guarded = ['EventRef'];
  protected $primaryKey   = 'EventRef';
  // protected $dates = ['StartDate', 'EndDate']; // Breaks fullcalendar

  public function poster()
  {
    return $this->belongsTo('App\User', 'Initiator');
  }

}
