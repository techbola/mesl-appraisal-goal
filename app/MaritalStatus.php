<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $guarded = ['MaritalStatusRef'];
    public $timestamps = false;
    protected $table   = 'tblMaritalStatus';
}