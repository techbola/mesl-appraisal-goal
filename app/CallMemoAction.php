<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class CallMemoAction extends Model
{
  protected $table   = 'tblCallMemoActions';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';


  public function user()
  {
    return $this->belongsTo('Cavidel\User', 'UserID');
  }

}
