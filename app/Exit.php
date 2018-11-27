<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class exit extends Model
{
    protected $table   = 'tblExit';
    protected $guarded = ['ExitRef'];
    public $timestamps = false;
}
