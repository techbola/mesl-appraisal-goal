<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class HandoverNote extends Model
{
    protected $table   = 'tblHandOverNote';
    protected $guarded = ['HandOverNoteRef'];
    public $primaryKey = 'HandOverNoteRef';
    // public $timestamps = false;

    public function leave_request()
    {
        return $this->belongsTo(LeaveRequest::class, 'LeaveRequestID');
    }

}
