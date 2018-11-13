<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Address1 extends Model
{
    protected $table   = 'address1';
    protected $guarded = ['Ref'];
    public $primaryKey = 'Ref';
    public $timestamps = false;
}
