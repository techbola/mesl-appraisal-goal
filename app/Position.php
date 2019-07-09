<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table   = 'tblPosition';
    protected $guarded = ['PositionRef'];
    public $timestamps = false;
    public $primaryKey = 'PositionRef';

    public function staff()
    {
        return $this->belongsTo('MESL\Staff');
    }

    public function behavioural_item()
    {
        return $this->belongsTo('MESL\BehaviouralItem', 'level_id');
    }

    public function staffs()
    {
        return $this->hasMany('MESL\Staff', 'PositionID');
    }

}
