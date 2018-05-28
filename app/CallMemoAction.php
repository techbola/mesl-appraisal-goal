<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CallMemoAction extends Model
{
  protected $table   = 'tblCallMemoAction';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';
}
