<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table   = 'tblBankAccount';
    protected $guarded = ['BankAccountRef'];
    public $primaryKey = 'BankAccountRef';
    public $timestamps = false;
}
