<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class ClientDocument extends Model
{
    protected $table   = 'tblClientDocuments';
    protected $guarded = ['DocRef'];
    public $primaryKey = 'DocRef';
    public $timestamps = false;

}
