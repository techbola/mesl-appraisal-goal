<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
  protected $table   = 'tblBankTransaction';
  protected $guarded = ['BankTransactionRef'];
  public $primaryKey = 'BankTransactionRef';
  public $timestamps = false;
}
