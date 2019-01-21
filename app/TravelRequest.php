<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    protected $table   = 'tblTravelRequest';
    protected $guarded = ['TravelRef'];
    public $primaryKey = 'TravelRef';
    public $timestamps = false;

    public function Travel_type()
    {
        return $this->belongsTo('MESL\TravelType', 'TravelType');
    }

    public function travel_from_state()
    {
        return $this->belongsTo('MESL\State', 'TravelFromState');
    }

    public function travel_to_state()
    {
        return $this->belongsTo('MESL\State', 'TravelToState');
    }


    public function travel_from_country()
    {
        return $this->belongsTo('MESL\Country', 'TravelFromCountry');
    }

    public function travel_to_country()
    {
        return $this->belongsTo('MESL\Country', 'TravelToCountry');
    }

    public function travel_purpose()
    {
        return $this->belongsTo('MESL\TravelPurpose', 'Purpose');
    }

    public function travel_lodge()
    {
        return $this->belongsTo('MESL\TravelLodge', 'Lodging');
    }

    public function travel_transporter()
    {
        return $this->belongsTo('MESL\TravelTransport', 'PreferredTransporter');   
    }

    public function requester_name()
    {
        return $this->belongsTo('MESL\User', 'RequesterID');
    }

   
}

