<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CallMemoFile extends Model
{
  protected $table   = 'tblCallMemoFiles';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';
}