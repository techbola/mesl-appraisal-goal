<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ProcessAttribute extends Model
{
    protected $table   = 'tblProcessAttribute';
    protected $guarded = ['process_attribute_ref'];
    public $timestamps = false;
}
