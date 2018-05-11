<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeductionItem extends Model
{
    protected $table      = 'tblDeductionItem';
    protected $primaryKey = 'DeductionItemRef';
    protected $guarded    = ['DeductionItemRef'];
    public $timestamps    = false;
}
