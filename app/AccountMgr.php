<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class AccountMgr extends Model
{
    protected $table   = 'tblAccountMgr';
    protected $guarded = ['AccountMgrRef'];
    public $primaryKey = 'AccountMgrRef';
    public $timestamps = false;
