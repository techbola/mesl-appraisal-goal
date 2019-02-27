<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class DocCategory extends Model
{
    protected $table   = 'tblDocCategory';
    protected $guarded = ['DocCategoryRef'];

    // public $timestamps = false;
    protected $primaryKey = 'DocCategoryRef';
    // public $timestamps = false;
}
