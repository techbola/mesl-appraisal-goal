<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table   = 'tblBranch';
    protected $guarded = ['BranchRef'];
    public $timestamps = false;
}
