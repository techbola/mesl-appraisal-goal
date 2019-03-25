<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class EmploymentReason extends Model
{
    protected $table   = 'tblEmploymentReason';
    protected $guarded = ['EmploymentReasonRef'];
    public $timestamps = false;
    public $primaryKey   = 'EmploymentReasonRef';
}
