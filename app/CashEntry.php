<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CashEntry extends Model
{
    protected $table   = 'tblCashEntry';
    protected $primaryKey = 'CashEntryRef';
    protected $guarded = ['CashEntryRef'];
    public $timestamps = false;
}
