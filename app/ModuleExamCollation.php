<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ModuleExamCollation extends Model
{
    protected $table   = 'tblModuleExamCollation';
    protected $guarded = ['ModuleExamCollationRef'];
    public $primaryKey = 'ModuleExamCollationRef';
    public $timestamps = false;
}
