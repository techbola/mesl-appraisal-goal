<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class CallMemoActionStatus extends Model
{
  protected $table   = 'tblCallMemoActionStatus';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';
  public $timestamps = false;
}
