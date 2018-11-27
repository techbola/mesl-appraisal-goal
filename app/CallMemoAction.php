<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CallMemoAction extends Model
{
  protected $table   = 'tblCallMemoActions';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';


  public function user()
  {
    return $this->belongsTo('MESL\User', 'UserID');
  }

  public function status()
  {
    return $this->belongsTo('MESL\CallMemoActionStatus', 'StatusID');
  }

}
