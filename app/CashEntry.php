<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CashEntry extends Model
{
    protected $table      = 'tblCashEntry';
    protected $primaryKey = 'CashEntryRef';
    protected $guarded    = ['CashEntryRef'];
    public $timestamps    = false;

    public function gl_debit()
    {
        return $this->belongsTo(GL::class, 'GLIDDebit', 'GLRef');
    }

    public function gl_credit()
    {
        return $this->belongsTo(GL::class, 'GLIDCredit', 'GLRef');
    }

    public function inputter()
    {
        return $this->belongsTo(Staff::class, 'InputterID', 'StaffRef');
    }

    public function bill_narrations()
    {
        return $this->belongsTo(BillNarration::class, 'Reference1', 'BillCode');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'BrandID', 'BrandRef');
    }
    public function product()
    {
        return $this->belongsTo(ProductCategory::class, 'Product', 'ProductCategoryRef');
    }

    public function signatory()
    {
        return $this->belongsTo(Staff::class, 'SignatoryID', 'StaffRef');
    }

    public function account_manager()
    {
        return $this->belongsTo(AccountManager::class, 'AccountMgrID', 'AccountMgrRef');
    }
}
