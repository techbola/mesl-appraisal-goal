<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    protected $table   = 'tblTraveller';
    protected $guarded = ['TravellerRef'];
    public $primaryKey = 'TravellerRef';
    // public $timestamps = false;

    public function internel_traveller()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }
}
