<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table   = 'tblReligion';
    protected $guarded = ['ReligionRef'];
    public $timestamps = false;
}
