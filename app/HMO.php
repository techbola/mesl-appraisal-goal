<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class HMO extends Model
{
    protected $table   = 'tblHMO';
    protected $guarded = ['HMORef'];
    protected $primaryKey = 'HMORef';
    public $timestamps = false;
}
