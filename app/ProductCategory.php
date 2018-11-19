<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table   = 'tblproductCategory';
    protected $guarded = ['productCategoryRef'];
    public $timestamps = false;
}
