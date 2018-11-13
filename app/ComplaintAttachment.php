<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class ComplaintAttachment extends Model
{
    protected $guarded = ['id'];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
