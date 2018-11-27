<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class LoanRatingStatus extends Model
{
  protected $table   = 'tblLoanRatingStatus';
  protected $guarded = ['StatusRef'];
  public $timestamps = false;

  public function reviewer()
  {
    return $this->belongsTo('MESL\User', 'UserID', 'id');
  }
}
