<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class MergedRecord extends Model
{
    protected $table   = 'tblMergedRecord';
    protected $guarded = ['MergedRecordRef'];
    public $primaryKey = 'MergedRecordRef';
    public $timestamps = false;
}
