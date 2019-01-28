<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table   = 'tblReligion';
    protected $guarded = ['ReligionRef'];

    protected $primaryKey = 'ReligionRef';
    public $timestamps    = false;
}
