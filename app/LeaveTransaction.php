<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class LeaveTransaction extends Model
{
    protected $table   = 'tblLeaveTransaction';
    protected $guarded = ['LeaveTransactionRef'];
    public $timestamps = false;
}
