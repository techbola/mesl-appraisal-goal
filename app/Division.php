<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table   = 'tblDivision';
    protected $guarded = ['DivisionRef'];
    public $timestamps = false;
}
