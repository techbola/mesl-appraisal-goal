<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table   = 'tblLocation';
    protected $guarded = ['LocationRef'];
    public $primaryKey = 'LocationRef';
    public $timestamps = false;
}
