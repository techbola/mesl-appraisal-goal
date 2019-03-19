<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class PFA extends Model
{
    protected $table   = 'tblPFA';
    protected $guarded = ['PFARef'];
    protected $primaryKey = 'PFARef';
    public $timestamps = false;
}
