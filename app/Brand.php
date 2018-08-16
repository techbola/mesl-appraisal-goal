<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table   = 'tblBrands';
    protected $guarded = ['BrandRef'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
