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

    public function travellers()
    {
        return $this->hasMany(Traveller::class, 'TravelRef', 'TravelRef');
    }

    public function sent()
    {
        return $this->SentForApproval;
    }

    public function processed()
    {
        return $this->processed_flag;
    }

    public function status()
    {
        if ($this->SentForApproval == 0) {
            return 'Not Sent';
        } elseif ($this->ApproverID == 0) {
            return true;
        } elseif ($this->ApproverID == $this->ApproverID1) {
            return 'With Approver 1 ' . '(' . Staff::where('UserID', $this->ApproverID1)->first()->Fullname . ')';
        } elseif ($this->ApproverID == $this->ApproverID2) {
            return 'With Approver 2 ' . '(' . Staff::where('UserID', $this->ApproverID2)->first()->Fullname . ')';
        } elseif ($this->ApproverID == $this->ApproverID3) {
            return 'With Approver 3 ' . '(' . Staff::where('UserID', $this->ApproverID3)->first()->Fullname . ')';
        } elseif ($this->ApproverID == $this->ApproverID4) {
            return 'With Approver 4 ' . '(' . Staff::where('UserID', $this->ApproverID4)->first()->Fullname . ')';
        }
    }

    public function approvers()
    {
        $approvers_array = [];
        if (!is_null($this->ApproverID1) && $this->ApproverID1 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID1)->first()->Fullname ?? '');
        }

        if (!is_null($this->ApproverID2) && $this->ApproverID2 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID2)->first()->Fullname ?? '');
        }

        if (!is_null($this->ApproverID3) && $this->ApproverID3 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID3)->first()->Fullname ?? '');
        }

        if (!is_null($this->ApproverID4) && $this->ApproverID4 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID4)->first()->Fullname);
        }

        return implode(', ', $approvers_array);
    }

    public function approved()
    {
        if ($this->ApproverID == 0 && $this->ApprovedFlag == true) {
            return true;
        } else {
            return false;
        }
    }

    public function initiator()
    {
        return $this->belongsTo(User::class, 'RequesterID', 'id');
    }

}
