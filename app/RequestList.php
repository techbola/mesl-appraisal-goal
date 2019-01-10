<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class RequestList extends Model
{
    protected $table      = 'tblRequestList';
    protected $guarded    = ['RequestListRef'];
    protected $primaryKey = 'RequestListRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function approvers()
    {
        $approvers     = array_filter(explode(',', $this->Approvers));
        $approver_list = array_map(function ($role) {
            return ApproverRole::find($role)->ApproverRole;

        }, $approvers);

        return $approver_list;
    }

    public function approvers_formatted($separator = '->')
    {
        return implode($this->approvers(), $separator);
    }

}
