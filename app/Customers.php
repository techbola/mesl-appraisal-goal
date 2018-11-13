<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table   = 'tblCustomer';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';


    public function projects()
    {
      return $this->hasMany('Cavi\Project', 'CustomerID');
    }

    public function country()
    {
      return $this->belongsTo('Cavi\Country', 'CountryID', 'CountryRef');
    }

}
