<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table   = 'tblCountry';
    protected $guarded = ['CountryRef'];
    public $timestamps = false;
}
