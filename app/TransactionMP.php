<?php

namespace Cavidel;

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
        return $this->belongsTo('Cavidel\GL', 'GLID', 'GLRef');
    }

    public function currency()
    {
        return $this->belongsTo('Cavidel\Currency', 'CurrencyID', 'CurrencyRef');
    }

}
