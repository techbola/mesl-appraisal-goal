<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExpenseManagement extends Model
{
    protected $table      = 'tblExpenseManagement';
    protected $guarded    = ['ExpenseManagementRef'];
    protected $primaryKey = 'ExpenseManagementRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function attachments()
    {
        return $this->hasMany(ExpenseManagementFile::class, 'ExpenseManagementID');
    }

    public function sent()
    {
        return $this->NotifyFlag;
    }

    public function request_type()
    {
        return $this->belongsTo(RequestList::class, 'RequestListID');
    }

    public function status()
    {
        if ($this->NotifyFlag == 0) {
            return 'Not Sent';
        } elseif ($this->CompletedFlag) {
            return 'Completed';
        } elseif (!$this->SupervisorApproved) {
            return 'Pending';
        } else {
            return ApproverRole::find($this->ApproverRoleID)->ApproverRole;
        }
    }

    public function expense_comments()
    {
        return $this->hasMany(ExpenseComment::class, 'ExpenseManagementID');
    }
}
