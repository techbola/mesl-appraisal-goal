<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table      = 'tblBrands';
    protected $guarded    = ['BrandRef'];
    protected $primaryKey = 'BrandRef';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function logo_location()
    {
        return $this->LogoLocation;
    }
}
