<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class ExpenseComment extends Model
{
    protected $table      = 'tblExpenseComment';
    protected $guarded    = ['ExpenseCommentRef'];
    protected $primaryKey = 'ExpenseCommentRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function attachments()
    {
        return $this->hasMany(ExpenseCommentFile::class, 'ExpenseCommentID');
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
        } else {
            return ApproverRole::find($this->ApproverRoleID)->ApproverRole;
        }
    }
}
