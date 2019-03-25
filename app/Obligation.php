<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    protected $table   = 'tblObligation';
    protected $guarded = ['ObligationRef'];
    public $timestamps = false;
    public $primaryKey   = 'ObligationRef';
}
