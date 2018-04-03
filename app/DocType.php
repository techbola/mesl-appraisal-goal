<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
  protected $table   = 'tblDocType';
  protected $guarded = ['DocTypeRef'];
}
