<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table   = 'tblCountry';
    protected $guarded = ['CountryRef'];
    public $primaryKey = 'CountryRef';
    public $timestamps = false;
}
