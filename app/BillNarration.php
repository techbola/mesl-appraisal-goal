<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class BillNarration extends Model
{
    protected $table   = 'tblBillNarration';
    protected $guarded = ['BillNarrationRef'];
    public $primaryKey = 'BillNarrationRef';
    public $timestamps = false;
}
