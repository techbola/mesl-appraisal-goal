<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class LoanRating extends Model
{
  protected $table   = 'tblLoanRating';
  protected $guarded = ['id'];
  // public $timestamps = false;

  public function status()
  {
    return $this->belongsTo('Cavi\LoanRatingStatus', 'StatusID', 'StatusRef');
  }

  public function customer()
  {
    return $this->belongsTo('Cavi\Customer', 'CustomerID', 'CustomerRef');
  }

  public function getFullNameAttribute()
  {
    return $this->FirstName.' '.$this->MiddleName.' '.$this->LastName;
  }

}
