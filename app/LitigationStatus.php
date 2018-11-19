<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class LitigationStatus extends Model
{
    protected $table   = 'tblLitigationStatus';
    protected $guarded = ['LitigationStatusRef'];

    public function litigation()
    {
        return $this->belongTo(Litigation::class);
    }
}
