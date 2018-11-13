<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table   = 'tblUnit';
    protected $guarded = ['UnitRef'];
    public $timestamps = false;
}
