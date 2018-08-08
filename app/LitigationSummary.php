<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class LitigationSummary extends Model
{
    protected $table    = 'tblLitigationStatus';
    protected $fillable = ['LitigationStatus'];

    public function litigation()
    {
        return $this->belongsTo(Litigation::class);
    }
}
