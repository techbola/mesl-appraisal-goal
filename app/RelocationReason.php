<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class RelocationReason extends Model
{
    protected $table   = 'tblRelocationReason';
    protected $guarded = ['RelocationReasonRef'];
    public $timestamps = false;
    public $primaryKey   = 'RelocationReasonRef';
}
