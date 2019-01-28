<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $guarded    = ['MaritalStatusRef'];
    protected $primaryKey = 'MaritalStatusRef';
    public $timestamps    = false;
    protected $table      = 'tblMaritalStatus';
}
