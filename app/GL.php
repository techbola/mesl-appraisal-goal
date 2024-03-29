<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class GL extends Model
{
    protected $guarded    = ['GLRef'];
    public $timestamps    = false;
    protected $table      = 'tblGL';
    protected $primaryKey = 'GLRef';

    public function customer()
    {
        return $this->belongsTo('MESL\Customer', 'CustomerID', 'CustomerRef');
    }

    public function real_customer()
    {
        return $this->belongsTo(Customers::class, 'CustomerID', 'CustomerRef');
    }

    public function account_type()
    {
        return $this->belongsTo('MESL\AccountType', 'AccountTypeID', 'AccountTypeRef');
    }

    public function currency()
    {
        return $this->belongsTo('MESL\Currency', 'CurrencyID', 'CurrencyRef');
    }

    public function bank()
    {
        return $this->belongsTo('MESL\Bank', 'BankID', 'BankRef');
    }

    public function branch()
    {
        return $this->belongsTo('MESL\Branch', 'BranchID', 'BranchRef');
    }

    public function loan_type()
    {
        return $this->belongsTo('MESL\LoanType', 'LoanTypeID', 'LoanTypeRef');
    }

    public function getAccountTitleAttribute()
    {
        if ($this->CustomerID == '195') {
            $name = $this->Description;
        } else {
            $name = ($this->customer) ? $this->customer->Customer : $this->Description;
        }
        $bank = ($this->bank) ? '(' . $this->bank->Bank . ')' : '';
        // $name = ($this->customer)? $this->customer->Customer : $this->Description;
        $type = ($this->account_type) ? $this->account_type->AccountType : '';
        return $name . ' - ' . $type . ' ' . $bank . ' [' . $this->BookBalance . ']';
    }
}
