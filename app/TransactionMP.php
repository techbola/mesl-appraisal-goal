<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class TransactionMP extends Model
{
    protected $guarded    = ['TransactionRef'];
    protected $primaryKey = 'TransactionRef';
    protected $table      = 'tblTransactionMP';
    public $timestamps    = false;

    public function gl()
    {
        return $this->belongsTo('Cavidel\GL', 'GLID', 'GLRef');
    }

    public function currency()
    {
        return $this->belongsTo('Cavidel\Currency', 'CurrencyID', 'CurrencyRef');
    }

}
