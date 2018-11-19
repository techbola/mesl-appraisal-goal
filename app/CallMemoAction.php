<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class CallMemoAction extends Model
{
  protected $table   = 'tblCallMemoActions';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';


  public function user()
  {
    return $this->belongsTo('Cavi\User', 'UserID');
  }

  public function status()
  {
    return $this->belongsTo('Cavi\CallMemoActionStatus', 'StatusID');
  }

}
