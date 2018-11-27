<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table   = 'tblMonths';
    protected $guarded = ['MonthsRef'];

    public $primaryKey = 'MonthsRef';
}
