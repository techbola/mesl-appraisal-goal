<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Department extends Model
{
    protected $table      = 'tblDepartment';
    protected $guarded    = ['DepartmentRef'];
    protected $primaryKey = 'DepartmentRef';
    public $timestamps    = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('Department', function (Builder $builder) {
            $builder->orderBy('Department');
        });
    }


    public function staff()
    {
      return Staff::whereRaw("CONCAT(',',DepartmentID,',') LIKE CONCAT('%,',".$this->DepartmentRef.",',%')")->get();
    }
}
