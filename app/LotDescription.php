<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class LotDescription extends Model
{
    protected $table      = 'tblLotDescription';
    protected $guarded    = ['LotDescriptionRef'];
    protected $primaryKey = 'LotDescriptionRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function attachments()
    {
        return $this->hasMany(LotDescriptionFile::class, 'LotDescriptionID');
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
            return ApproverRole::find($this->ApproverRoleID)->ApproverRole ?? 'Completed';
        }
    }

    public function expense_comments()
    {
        return $this->hasMany(ExpenseComment::class, 'LotDescriptionID');
    }

    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'ExpenseCategoryID');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentID');
    }
}
