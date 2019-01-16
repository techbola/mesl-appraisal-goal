<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExpenseManagementFile extends Model
{
    protected $table      = 'tblExpenseManagementFile';
    protected $guarded    = ['ExpenseManagementFileRef'];
    protected $primaryKey = 'ExpenseManagementFileRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
