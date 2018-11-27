<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table   = 'tblCompany';
    protected $guarded = ['CompanyRef'];
    public $timestamps = false;

    public $primaryKey   = 'CompanyRef';
}
