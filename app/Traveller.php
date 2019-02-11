<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    protected $table   = 'tblTraveller';
    protected $guarded = ['TravellerRef'];
    public $primaryKey = 'TravellerRef';
    // public $timestamps = false;
}
