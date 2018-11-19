<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class BillNarration extends Model
{
    protected $table   = 'tblBillNarration';
    protected $guarded = ['BillNarrationRef'];
    public $primaryKey = 'BillNarrationRef';
    public $timestamps = false;

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'BrandID', 'BrandRef');
    }

}
