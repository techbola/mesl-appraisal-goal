<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table   = 'tblBanks';
    protected $guarded = ['BankRef'];
    public $timestamps = false;
}
