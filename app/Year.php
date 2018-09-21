<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table   = 'tblYears';
    protected $guarded = ['YearsRef'];

    public $primaryKey = 'YearsRef';
}
