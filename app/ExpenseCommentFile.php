<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExpenseCommentFile extends Model
{
    protected $table      = 'tblExpenseCommentFile';
    protected $guarded    = ['ExpenseCommentFileRef'];
    protected $primaryKey = 'ExpenseCommentFileRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function attachments()
    {
        return $this->hasMany(ExpenseCommentFile::class, 'ExpenseCommentID');
    }

    public function expense_management()
    {
        return $this->belongsTo('ExpenseManagement', 'ExpenseManagementID');
    }
}
