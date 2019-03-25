<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    protected $table   = 'tblDocType';
    protected $guarded = ['DocTypeRef'];
    protected $primaryKey = 'DocTypeRef';
    public $timestamps = false;


    public function category()
    {
        return $this->belongsTo(DocCategory::class, 'DocCategory');
    }

    public function staff_company()
    {
        return $this->belongsTo(Company::class, 'CompanyID');
    }
}
