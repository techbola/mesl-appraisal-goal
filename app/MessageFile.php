<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
  protected $table   = 'tblMessageFiles';
  protected $guarded = ['FileRef'];
  public $primaryKey = 'FileRef';
}
