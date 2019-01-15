<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class HandoverTask extends Model
{
    protected $table   = 'tblHandoverTask';
    protected $guarded = ['HandoverRef'];
    public $timestamps = false;
}
