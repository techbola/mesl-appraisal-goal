<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table   = 'tblBank';
    protected $guarded = ['BankRef'];
    protected $primaryKey = 'BankRef';
    public $timestamps = false;

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'CurrencyID');
    }
}
