<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PolicyStatement extends Model
{
    protected $table   = 'tblPolicyStatement';
    protected $guarded = ['StatementRef'];
    public $primaryKey = 'StatementRef';
    public $timestamps = false;
}
