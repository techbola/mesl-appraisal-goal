<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    protected $fillable = ['name'];

    public $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('MESL\User');
    }

    public function behavioural_item()
    {
        return $this->belongsTo('MESL\BehaviouralItem', 'level_id');
    }

}
