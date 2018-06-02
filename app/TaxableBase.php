<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Taxablebase extends Model
{
    protected $table   = 'tblTaxableBase';
    protected $guarded = ['TaxableBaseRef'];
    public $timestamps = false;
}
