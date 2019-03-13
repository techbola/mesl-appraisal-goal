<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffPending extends Model
{
    use SoftDeletes;

    protected $table   = 'tblStaffPending';
    protected $guarded = [
        'id', 'RefName', 'RefRelationship', 'RefOccupation',
        'RefPhone', 'RefEmail', 'RefAddress', 'Qualification', 'ProfDateObtained',
        'Institution', 'QualificationObtained', 'DateObtained',
    ];
    public $primaryKey = 'id';
    public $dates      = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('MESL\User', 'UserID');
    }

    public function religion()
    {
        return $this->belongsTo('MESL\Religion', 'ReligionID');
    }

    public function state_of_origin()
    {
        return $this->belongsTo('MESL\State', 'StateofOrigin');
    }

    public function nysc_location()
    {
        return $this->belongsTo('MESL\State', 'NYSCLocationID');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'GenderID');
    }

    public function marital_status()
    {
        return $this->belongsTo(MaritalStatus::class, 'MaritalStatusID');
    }

    public function country_of_origin()
    {
        return $this->belongsTo('MESL\Country', 'CountryOfOrigin');
    }

    public function country_of_birth()
    {
        return $this->belongsTo('MESL\Country', 'CountryOfBirth');
    }

}
