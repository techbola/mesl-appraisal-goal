<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table   = 'tblCurrency';
    protected $guarded = ['CurrencyRef'];
    public $timestamps = false;
}
