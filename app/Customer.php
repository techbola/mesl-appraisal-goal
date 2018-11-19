<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table   = 'tblCustomer';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';
    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany('Cavi\Project', 'ClientID');
    }

    public function account_manager()
    {
        return $this->belongsTo('Cavi\AccountMgr', 'AccountMgrID');
    }

    public function house_type()
    {
        return $this->belongsTo('Cavi\HouseType', 'HouseTypeID');
    }

    public function paymentplan()
    {
        return $this->belongsTo('Cavi\HouseType', 'PaymentPlanID');
    }

    public function estate_allocation()
    {
        return $this->hasOne('Cavi\EstateAllocation', 'CustomerID');
    }

}
