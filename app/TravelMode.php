<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TravelMode extends Model
{
    protected $table   = 'tblTravelMode';
    protected $guarded = ['TravelModeRef'];
    public $primaryKey = 'TravelModeRef';
    public $timestamps = false;
}
