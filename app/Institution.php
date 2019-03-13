<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $table      = 'tblInstitution';
    protected $guarded    = ['InstitutionRef'];
    protected $primaryKey = 'InstitutionRef';

    public function user()
    {
        return $this->belongsTo(Staff::class, 'StaffID');
    }
}
