<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table   = 'tblProcess';
    protected $guarded = ['ProcessRef'];
    public $primaryKey = 'ProcessRef';
    public $timestamps = false;
}
