<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiskRegister extends Model
{
    protected $table      = 'tblRiskRegister';
    protected $guarded    = ['RiskRegisterRef'];
    protected $primaryKey = 'RiskRegisterRef';
    public $timestamps    = false;
    const CREATED_AT      = 'InputDateTime';
    const UPDATED_AT      = 'ModifiedDateTime';
}
