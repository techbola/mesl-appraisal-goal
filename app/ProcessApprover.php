<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ProcessApprover extends Model
{
    protected $table   = 'tblProcessApprover';
    protected $guarded = ['ProcessApproverRef'];
    public $primaryKey = 'ProcessApproverRef';
    public $timestamps = false;
}
