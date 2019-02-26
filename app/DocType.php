<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    protected $table   = 'tblDocType';
    protected $guarded = ['DocTypeRef'];
    protected $primaryKey = 'DocTypeRef';
    public $timestamps = false;


    public function doc_category()
    {
        return $this->belongsTo(DocCategory::class, 'DocCategoryID');
    }

    public function staff_company()
    {
        return $this->belongsTo(Company::class, 'CompanyID');
    }
}
