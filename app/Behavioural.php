<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Behavioural extends Model
{
	
    protected $fillable = [
        'behaviouralCat',
    ];

    public function behaviouralItems()
    {
        return $this->hasMany('MESL\BehaviouralItem', 'behaviouralCat_id');
    }

    public function getUserBehaviourals()
    {
        $staffBehaviouralCats = [];

        $staff_behavioural_items_catids = BehaviouralItem::where('PositionID', auth()->user()->staff->position->PositionRef)->pluck('behaviouralCat_id')->all();

        foreach ($staff_behavioural_items_catids as $staff_behavioural_items_catid){
            array_push($staffBehaviouralCats, (int) $staff_behavioural_items_catid);
        }

        $behaviourals = Behavioural::pluck('id')->all();

        $behaviourals2 = array_intersect ($behaviourals, $staffBehaviouralCats);

        $behaviourals3 = Behavioural::whereIn('id', $behaviourals2)->get();

        return $behaviourals3;
    }

    public function behaviouralUserItems()
    {
        return $this->hasMany('MESL\BehaviouralItem', 'behaviouralCat_id')
            ->where('PositionID', auth()->user()->staff->position->PositionRef);
    }

    public function behaviouralStaffItems($staffPositionID)
    {
        return $this->hasMany('MESL\BehaviouralItem', 'behaviouralCat_id')
            ->where('PositionID', $staffPositionID)->get();
    }

}
