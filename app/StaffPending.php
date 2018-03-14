<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPending extends Model
{
  protected $table   = 'tblStaffPending';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';


  public function user()
  {
    return $this->belongsTo('App\User', 'UserID');
  }

}
