<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class PolicySegment extends Model
{
    protected $table   = 'tblPolicySegment';
    protected $guarded = ['SegmentRef'];
    public $primaryKey = 'SegmentRef';
    public $timestamps = false;

    public function policy()
    {
        return $this->belongsTo('Cavidel\Policy', 'PolicyID');
    }
}
