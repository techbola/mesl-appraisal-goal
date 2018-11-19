<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class EstateInfo extends Model
{
  protected $table   = 'tblEstateInfo';
  protected $guarded = ['EstateInfoRef'];
  protected $primaryKey   = 'EstateInfoRef';
}
