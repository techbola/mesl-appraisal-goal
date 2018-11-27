<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table   = 'tblState';
    protected $guarded = ['StateRef'];
    public $primaryKey = 'StateRef';
    public $timestamps = false;
}
