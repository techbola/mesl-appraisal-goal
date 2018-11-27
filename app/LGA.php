<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
  protected $table   = 'tblLGA';
  protected $guarded = ['LGARef'];
  public $timestamps = false;
  public $primaryKey   = 'LGARef';
}
