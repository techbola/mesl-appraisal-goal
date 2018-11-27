<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class PolicySegment extends Model
{
    protected $table   = 'tblPolicySegment';
    protected $guarded = ['SegmentRef'];
    public $primaryKey = 'SegmentRef';
    public $timestamps = false;

    public function policy()
    {
        return $this->belongsTo('MESL\Policy', 'PolicyID');
    }
}
