<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class DocCategory extends Model
{
    protected $table   = 'tblDocCategory';
    protected $guarded = ['DocCategoryRef'];
    protected $primaryKey = 'DocCategoryRef';
    public $timestamps = false;

}
