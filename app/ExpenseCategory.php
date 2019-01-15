<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table      = 'tblExpenseCategory';
    protected $guarded    = ['ExpenseCategoryRef'];
    protected $primaryKey = 'ExpenseCategoryRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
