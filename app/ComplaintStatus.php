<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ComplaintStatus extends Model
{
    protected $table      = 'tblComplaintStatus';
    protected $guarded    = ['ComplaintStatusRef'];
    protected $primaryKey = 'ComplaintStatusRef';
    protected $timestamp  = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
