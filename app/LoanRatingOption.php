<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class LoanRatingOption extends Model
{
  protected $table   = 'tblLoanRatingOptions';
  protected $guarded = ['id'];
  public $timestamps = false;
}
