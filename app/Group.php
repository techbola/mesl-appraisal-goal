<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table   = 'tblGroup';
    protected $guarded = ['GroupRef'];
    public $timestamps = false;
}
