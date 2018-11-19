<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $table   = 'tblproductService';
    protected $guarded = ['productServiceRef'];
    public $timestamps = false;
}
