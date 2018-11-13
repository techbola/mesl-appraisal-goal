<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table   = 'tblConfig';
    protected $guarded = ['ConfigRef'];
    public $primaryKey = 'ConfigRef';
}
