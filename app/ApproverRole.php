<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ApproverRole extends Model
{
    protected $table      = 'tblApproverRole';
    protected $guarded    = ['ApproverRoleRef'];
    protected $primaryKey = 'ApproverRoleRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
