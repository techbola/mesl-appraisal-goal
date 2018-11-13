<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['TransactionRef'];
    protected $table   = 'tblTransaction';
    public $timestamps = false;

    public function gl(){
      return $this->belongsTo('Cavi\GL', 'GLID', 'GLRef');
    }

    public function currency(){
      return $this->belongsTo('Cavi\Currency', 'CurrencyID', 'CurrencyRef');
    }
}
