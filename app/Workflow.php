<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $table      = 'tblWorkflowData';
    protected $guarded    = ['WorkflowRef'];
    protected $primaryKey = 'WorkflowRef';
    public $timestamps    = false;

    const CREATED_AT = 'InputDatetime';
    const UPDATED_AT = 'ModifiedDatetime';

    public function initiator()
    {
        return $this->belongsTo(Role::class, 'RequesterID');
    }

    public function role_1()
    {
        return $this->belongsTo(Role::class, 'ApproverID1');
    }

    public function role_2()
    {
        return $this->belongsTo(Role::class, 'ApproverID2');
    }

    public function role_3()
    {
        return $this->belongsTo(Role::class, 'ApproverID3');
    }

    public function role_4()
    {
        return $this->belongsTo(Role::class, 'ApproverID4');
    }
}
