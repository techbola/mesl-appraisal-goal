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
}
