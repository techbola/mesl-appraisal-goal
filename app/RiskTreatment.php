<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class RiskTreatment extends Model
{
    protected $table   = 'tblRiskTreatment';
    protected $guarded = ['RiskTreatmentRef'];
    public $timestamps = false;
    const CREATED_AT   = 'InputDateTime';
    const UPDATED_AT   = 'ModifiedDateTime';
}
