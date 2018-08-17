<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table   = 'tblVendors';
    protected $guarded = ['VendorRef'];
    public $primaryKey = 'VendorRef';
    public $timestamps = false;
}
