<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ResidualRiskType extends Model
{
    protected $table   = 'tblResidualRiskType';
    protected $guarded = ['ResidualRiskTypeRef'];
    public $timestamps = false;
    const CREATED_AT   = 'InputDateTime';
    const UPDATED_AT   = 'ModifiedDateTime';
}
