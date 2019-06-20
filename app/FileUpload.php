<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
   protected $table   = 'tblFileUpload';
    protected $guarded = ['FileRef'];
    public $primaryKey = 'FileRef';
    public $timestamps = false;
}
