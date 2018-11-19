<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table   = 'tblBilling';
    protected $guarded = ['BillingID'];
    public $primaryKey = 'BillingID';
    public $timestamps = false;
}
