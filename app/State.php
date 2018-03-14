<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table   = 'tblState';
    protected $guarded = ['StateRef'];
    public $timestamps = false;
}
