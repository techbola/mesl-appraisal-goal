<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class BusinessContact extends Model
{
  protected $table   = 'tblBusinessContacts';
  protected $guarded = ['ContactRef'];
  public $primaryKey = 'ContactRef';

  public function country()
  {
    return $this->belongsTo('MESL\Country', 'CountryID', 'CountryRef');
  }
}
