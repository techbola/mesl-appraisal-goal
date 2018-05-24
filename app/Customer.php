<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table   = 'tblContacts';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';


    public function projects()
    {
      return $this->hasMany('Cavidel\Project', 'CustomerID');
    }

    public function country()
    {
      return $this->belongsTo('Cavidel\Country', 'CountryID', 'CountryRef');
    }

}
