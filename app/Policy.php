<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $table   = 'tblPolicy';
    protected $guarded = ['PolicyRef'];
    public $primaryKey = 'PolicyRef';
    public $timestamps = false;

    public function policy_segments()
    {
        return $this->hasMany('MESL\PolicySegment', 'PolicyID');
    }
}
