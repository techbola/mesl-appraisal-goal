<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table   = 'tblCustomer';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';


    public function projects()
    {
      return $this->hasMany('MESL\Project', 'CustomerID');
    }

    public function country()
    {
      return $this->belongsTo('MESL\Country', 'CountryID', 'CountryRef');
    }

}
