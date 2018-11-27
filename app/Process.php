<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table   = 'tblProcesses';
    protected $guarded = ['ProcessRef'];
    public $primaryKey = 'ProcessRef';
    public $timestamps = false;
}
