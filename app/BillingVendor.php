<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class BillingVendor extends Model
{
    protected $table   = 'tblBilling_Vendor';
    protected $guarded = ['BillingID'];
    public $primaryKey = 'BillingID';
    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class, 'ProjectID', 'ProjectRef');
    }
}
