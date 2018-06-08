<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table      = 'tblDepartment';
    protected $guarded    = ['DepartmentRef'];
    protected $primaryKey = 'DepartmentRef';
    public $timestamps    = false;
}
