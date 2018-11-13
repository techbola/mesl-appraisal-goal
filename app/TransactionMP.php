<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TransactionMP extends Model
{
    use SoftDeletes;

    protected $guarded    = ['TransactionRef'];
    protected $primaryKey = 'TransactionRef';
    protected $table      = 'tblTransactionMP';
    public $timestamps    = false;
    protected $dates      = ['deleted_at'];

    public function gl()
    {
        return $this->belongsTo('Cavi\GL', 'GLID', 'GLRef');
    }

    public function currency()
    {
        return $this->belongsTo('Cavi\Currency', 'CurrencyID', 'CurrencyRef');
    }

}
