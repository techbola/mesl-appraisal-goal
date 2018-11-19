<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class TrainingAgency extends Model
{
    protected $guarded = ['AgencyRef'];
    protected $table   = 'tblTrainingAgency';
    public $primaryKey = 'AgencyRef';
    public $timestamps = false;
}
