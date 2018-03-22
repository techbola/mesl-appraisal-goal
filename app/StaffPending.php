<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffPending extends Model
{
  use SoftDeletes;

  protected $table   = 'tblStaffPending';
  protected $guarded = ['id'];
  public $primaryKey   = 'id';
  public $dates = ['deleted_at'];



  public function user()
  {
    return $this->belongsTo('App\User', 'UserID');
  }

}
