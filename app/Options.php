<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table   = 'tblOptions';
    protected $guarded = ['OptionsRef'];
    public $timestamps = false;
    public $primaryKey   = 'OptionsRef';
}
