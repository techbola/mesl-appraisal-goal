<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $table   = 'tblClients';
  protected $guarded = ['ClientRef'];
  public $primaryKey = 'ClientRef';
  
  public function projects()
  {
    return $this->hasMany('Cavidel\Project', 'ClientID');
  }

}
