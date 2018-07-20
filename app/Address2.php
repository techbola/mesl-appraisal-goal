<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Address2 extends Model
{
    protected $table   = 'address2';
    protected $guarded = ['Ref'];
    public $primaryKey = 'Ref';
    public $timestamps = false;
}
