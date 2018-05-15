<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeniorityLevel extends Model
{
    protected $table    = 'Honeywell.tblSeniorityLevel';
    protected $fillable = ['SeniorityLevel', 'GradeLevel'];
    public $primaryKey  = 'SeniorityRef';
    public $timestamps  = false;
}
