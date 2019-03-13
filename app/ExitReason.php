<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExitReason extends Model
{
    protected $table   = 'tblExitReason';
    protected $guarded = ['ExitReasonRef'];
    public $timestamps = false;
    public $primaryKey   = 'ExitReasonRef';
}
