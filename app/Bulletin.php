<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
  protected $table   = 'tblBulletin';
  protected $guarded = ['BulletinRef'];
  public $primaryKey = 'BulletinRef';
  public $timestamps = false;
  public $dates = ['CreatedDate'];

  public function poster()
  {
    return $this->belongsTo('Cavi\User', 'CreatedBy');
  }

  public function getCreatedDateAttribute($value)
  {
    return \Carbon\Carbon::parse($value);
  }

}
