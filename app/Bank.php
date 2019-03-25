<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table   = 'tblBank';
    protected $guarded = ['BankRef'];
    protected $primaryKey = 'tblBank';
    public $timestamps = false;
}
