<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    public function travel_mode()
    {
        return $this->belongsTo(TravelMode::class);
    }

    public function relocation_reason()
    {
        return $this->belongsTo(RelocationReason::class, 'RelocationReasonID');
    }

    public function purpose()
    {
        return $this->belongsTo(TravelPurpose::class, 'TravelPurposeID');
    }

    public function staff_name()
    {
        return $this->belongsTo(Staff::class, 'StaffRef');
    }

}
