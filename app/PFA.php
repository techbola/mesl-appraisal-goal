<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class PFA extends Model
{
    protected $table   = 'tblPFA';
    protected $guarded = ['PFARef'];
    public $timestamps = false;
}
