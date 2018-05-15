<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanRating extends Model
{
  protected $table   = 'tblLoanRating';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function status()
  {
    return $this->belongsTo('App\LoanRatingStatus', 'StatusID', 'StatusRef');
  }

  public function customer()
  {
    return $this->belongsTo('App\Customer', 'CustomerID', 'CustomerRef');
  }

  public function getFullNameAttribute()
  {
    return $this->FirstName.' '.$this->MiddleName.' '.$this->LastName;
  }

}
