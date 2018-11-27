<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table   = 'tblCustomer';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';
    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany('MESL\Project', 'ClientID');
    }

    public function account_manager()
    {
        return $this->belongsTo('MESL\AccountMgr', 'AccountMgrID');
    }

    public function house_type()
    {
        return $this->belongsTo('MESL\HouseType', 'HouseTypeID');
    }

    public function paymentplan()
    {
        return $this->belongsTo('MESL\HouseType', 'PaymentPlanID');
    }

    public function estate_allocation()
    {
        return $this->hasOne('MESL\EstateAllocation', 'CustomerID');
    }

}
