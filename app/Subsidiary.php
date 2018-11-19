<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    protected $table   = 'tblSubsidiary';
    protected $guarded = ['SubsidiaryRef'];
    public $timestamps = false;
}
