<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $guarded = ['TransactionTypeRef'];
    protected $table   = 'tblTransactionType';
}
