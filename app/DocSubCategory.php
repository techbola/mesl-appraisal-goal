<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class DocSubCategory extends Model
{
    protected $table   = 'tblDocSubCategory';
    protected $guarded = ['DocSubCategoryRef'];
    // public $timestamps = false;
}
