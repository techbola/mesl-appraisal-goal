<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TravelType extends Model
{
    protected $table   = 'tblTravelType';
    protected $guarded = ['TravelTypeRef'];
    public $primaryKey = 'TravelTypeRef';
    public $timestamps = false;
}
