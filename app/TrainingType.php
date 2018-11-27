<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
{
    protected $table   = 'tblTrainingType';
    protected $guarded = ['TrainingTypeRef'];
    public $primaryKey = 'TrainingTypeRef';
    public $timestamps = false;
}
