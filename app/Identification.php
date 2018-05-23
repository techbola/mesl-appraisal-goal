<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{
    protected $table   = 'tblIdentification';
    protected $guarded = ['IdentificationRef'];
     public $timestamps = false;
}
