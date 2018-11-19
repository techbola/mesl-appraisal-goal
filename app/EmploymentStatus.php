<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    protected $table   = 'tblEmploymentStatus';
    protected $guarded = ['EmploymentStatusRef'];
    public $timestamps = false;
}
