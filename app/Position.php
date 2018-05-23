<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table   = 'tblPosition';
    protected $guarded = ['PositionRef'];
    public $timestamps = false;
}
