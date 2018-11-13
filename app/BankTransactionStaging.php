<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class BankTransactionStaging extends Model
{
  protected $table   = 'tblBankTransactionStaging';
  protected $guarded = ['BankTransactionRef'];
  public $primaryKey = 'BankTransactionRef';
  public $timestamps = false;
}
