<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class RestrictionDates extends Model
{
    protected $table   = 'tblRestrictionDates';
    protected $guarded = ['LeaveRestrictionRef'];
    public $timestamps = false;
}
