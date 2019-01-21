<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TravelLodge extends Model
{
    protected $table   = 'tblTravelLodge';
    protected $guarded = ['TravelLodgeRef'];
    public $primaryKey = 'TravelLodgeRef';
    public $timestamps = false;
}
