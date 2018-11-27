<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    protected $table   = 'tblDocType';
    protected $guarded = ['DocTypeRef'];
    public $timestamps = false;
}
