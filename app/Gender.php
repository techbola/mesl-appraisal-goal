<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  protected $table   = 'tblGender';
  protected $guarded = ['GenderRef'];

  public $primaryKey   = 'GenderRef';
}
