<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class BehaviouralItem extends Model
{

	protected $fillable = [
        'behaviouralCat_id', 'level_id', 'behaviouralItem', 'weight',
    ];

    public $primaryKey = 'id';

    public function behavioural()
    {
        return $this->belongsTo('MESL\Behavioural', 'behaviouralCat_id');
	}

    public function level()
    {
        return $this->belongsTo('MESL\Level', 'level_id');
    }

    public function staffBehaviouralItem()
    {
        return $this->hasOne('MESL\StaffBehaviouralItem', 'behaviouralItem_id');
    }

}
