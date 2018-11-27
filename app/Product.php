<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table   = 'tblProduct';
    protected $guarded = ['ProductRef'];
    public $primaryKey = 'ProductRef';
    public $timestamps = false;
}
