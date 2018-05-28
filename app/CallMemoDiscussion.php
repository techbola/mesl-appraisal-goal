<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CallMemoDiscussion extends Model
{
  protected $table   = 'tblCallMemoDiscussion';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';
}
