<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ComplaintComment extends Model
{
    protected $guarded = ['id'];

    public function complaint()
    {
        return $this->hasOne(Complaint::class, 'complaint_id');
    }
}
