<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table   = 'tblCustomer';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';


    public function projects()
    {
      return $this->hasMany('App\Project', 'CustomerID');
    }

    public function country()
    {
      return $this->belongsTo('App\Country', 'CountryID', 'CountryRef');
    }

}
