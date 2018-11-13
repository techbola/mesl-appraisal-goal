<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class ProcessDept extends Model
{
    protected $table   = 'tblProcessDept';
    protected $guarded = ['DeptRef'];
    public $primaryKey = 'DeptRef';
    public $timestamps = false;
}
