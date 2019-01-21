<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TravelPurpose extends Model
{
    protected $table   = 'tblTravelPurpose';
    protected $guarded = ['TravelPurposeRef'];
    public $primaryKey = 'TravelPurposeRef';
    public $timestamps = false;
}
