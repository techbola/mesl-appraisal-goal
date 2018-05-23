<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class RiskType extends Model
{
    protected $table   = 'tblRiskType';
    protected $guarded = ['RiskTypeRef'];
    public $timestamps = false;
    const CREATED_AT   = 'InputDateTime';
    const UPDATED_AT   = 'ModifiedDateTime';
}
