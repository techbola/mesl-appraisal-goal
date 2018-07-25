<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class ProductDeleted extends Model
{
    protected $table   = 'tblProductDeleted';
    protected $guarded = ['ProductDeletedRef'];
    public $timestamps = false;
}