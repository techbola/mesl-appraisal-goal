<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PolicyApprover extends Model
{
    protected $table   = 'tblPolicyApprover';
    protected $guarded = ['PolicyApproverRef'];
    public $primaryKey = 'PolicyApproverRef';
    public $timestamps = false;
}
