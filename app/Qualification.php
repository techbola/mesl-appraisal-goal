<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table      = 'tblQualification';
    protected $guarded    = ['QualificationRef'];
    protected $primaryKey = 'QualificationRef';

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }
}
