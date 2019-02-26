<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table   = 'tblSubCategory';
    protected $guarded = ['SubCategoryRef'];
    protected $primaryKey = 'SubCategoryRef';
    public $timestamps = false;

    public function doc_category()
    {
        return $this->belongsTo(DocCategory::class, 'DocCategoryID');
    }
}
