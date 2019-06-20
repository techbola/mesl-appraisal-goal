<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ComplaintComment extends Model
{
    protected $guarded = ['id'];

    public function complaint()
    {
        return $this->hasOne(Complaint::class, 'complaint_id');
    }

    public function attachments()
    {
        return $this->hasMany(ComplaintAttachment::class, 'comment_id');
    }

    public function complaint_status()
    {
        return $this->belongsTo(ComplaintStatus::class, 'complaint_status_id');
    }
}
