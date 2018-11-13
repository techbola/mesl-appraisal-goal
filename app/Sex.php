<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    protected $table   = 'tblSex';
    protected $guarded = ['SexRef'];
    public $timestamps = false;
}
