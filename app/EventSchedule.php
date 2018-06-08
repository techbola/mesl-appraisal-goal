<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
  protected $table   = 'tblEventSchedule';
  protected $guarded = ['EventRef'];
  protected $primaryKey   = 'EventRef';
  // protected $dates = ['StartDate', 'EndDate']; // Breaks fullcalendar

  public function poster()
  {
    return $this->belongsTo('Cavidel\User', 'Initiator');
  }

  // public function setEndDateAttribute($value)
  // {
  //   $date = date_create($value);
  //   date_add($date, date_interval_create_from_date_string('1 days'));
  //   $new_date = date_format($date, 'Y-m-d');
  //   return $new_date;
  // }
  //
  // public function getEndDateAttribute($value)
  // {
  //   $date = date_create($value);
  //   date_sub($date, date_interval_create_from_date_string('1 days'));
  //   return date_format($date, 'Y-m-d');
  // }

}
