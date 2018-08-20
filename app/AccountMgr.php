<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class AccountMgr extends Model
{
    protected $table      = 'tblAccountMgr';
    protected $guarded    = ['AccountMgrRef'];
    protected $primaryKey = 'AccountMgrRef';
    public $timestamps    = false;
}
