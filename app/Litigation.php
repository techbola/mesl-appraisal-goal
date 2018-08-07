<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Litigation extends Model
{
    protected $table   = 'tblLitigation';
    protected $guarded = ['LitigationRef'];

    public function litigation_summary()
    {
        return $this->HasMany(LitigationSummary::class);
    }
}
