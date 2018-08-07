<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class LitigationSummary extends Model
{
    protected $table    = 'tblLitigationSummary';
    protected $fillable = ['LitigationSummary'];

    public function litigation()
    {
        return $this->belongsTo(Litigation::class);
    }
}
