<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Exit extends Model
{
    protected $table   = 'tblExit';
    protected $guarded = ['ExitRef'];
    protected $primaryKey = 'ExitRef';
    public $timestamps = false;
}
